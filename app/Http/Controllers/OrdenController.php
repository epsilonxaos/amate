<?php

namespace App\Http\Controllers;

use App\Asiento;
use App\Evento;
use App\EventoHorario;
use App\EventoPrecio;
use App\Orden;
use App\OrdenPerAsiento;
use BaconQrCode\Encoder\QrCode;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\Factory;
use Jenssegers\Optimus\Optimus;

class OrdenController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $info = [
            'title' => 'Ventas',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.orden.list',
                    'active' => true
                ]
            ],
            'buttons' => [
                [
                    'title' => 'Vender Boleto',
                    'route' => 'panel.orden.crear'
                ]
            ]
        ];
        $orden = Orden::orderBy('id', 'DESC')->get();
        foreach ($orden as $o){
            $asientos =  OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $o->id)->get()->toArray();
            $o->no_boletos = count($asientos);
            $o -> status_string = self::getStatus($o->status);
            $o -> fecha_string = self::formatedDate($o->created_at);
        }
        $info['data'] = $orden;
        return view('panel.orden.list', $info);
    }

    public function crear()
    {
        $info = [
            'title' => 'Vender Boletos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.orden.list',
                    'active' => false
                ],
                [
                    'title' => 'Vender Boletos',
                    'route' => 'panel.orden.crear',
                    'active' => true
                ]
            ],
        ];
        $eventos = Evento::select(['id', 'titulo',  'lugar',  'tipo'])->get();
        foreach ($eventos as $ev){
            $horarios = EventoHorario::where('evento_id', $ev -> id)->orderBy('fecha', 'ASC')->orderBy('hora', 'ASC')->get();
            foreach ($horarios as $horario){
                $horario->fecha = self::formatedDate($horario -> fecha);
            }
            $ev -> horarios = $horarios;
            $precios = EventoPrecio::where('evento_id', $ev -> id)->where('tipo', 0)->get();
            foreach ($precios  as $precio){
                $precio -> precio_final = (($precio -> precio * $precio -> comision) / 100) + $precio -> precio;
            }
            $ev -> precios = $precios;
        }
        $info['eventos'] = $eventos;

        return view('panel.orden.create', $info);
    }

    public function edit($id)
    {
        $orden = Orden::find($id);
        $orden -> fecha_string = self::formatedDate($orden -> dia);
        $orden -> status_string = self::getStatus($orden -> status);
        $orden -> pago_hora_string = self::formatedDateHora($orden -> pago_hora);
        $orden -> json_informacion = json_decode($orden ->informacion);

        $orden -> asientos = OrdenPerAsiento::select(['asiento.folio', 'asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $id)->get();
        //$orden -> asientos_string = FrontController::asientosToString($orden->asientos);
        $subtotal = $orden -> precio_boleto * $orden -> no_boletos;
        $orden -> subtotal = number_format($subtotal,2);
        $total = $subtotal - $orden -> descuento;
        $orden -> total = number_format($total,2);

        $info = [
            'title' => 'Ventas',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.orden.list',
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.orden.edit',
                    'params' => ['id' => $id],
                    'active' => true
                ]
            ]
        ];

        $info['orden'] = $orden;
        return view('panel.orden.detail', $info);
    }


    public function store(Request $request, Optimus $optimus){
        $horario = EventoHorario::find($request->horario_id);
        $orden = Orden::create([
            'evento_id'=>$request -> evento_id,
            'horario_id' => $request -> horario_id,
            'dia' => $horario->fecha,
            'hora' => $horario->hora,
        ]);
        $orden -> folio = $optimus->encode($orden->id);
        $orden -> evento_titulo = $request -> evento_titulo;
        $orden -> nombre_completo = $request -> customer_name;
        $orden -> correo = $request -> customer_email;
        $orden -> telefono = $request -> customer_phone;
        $orden -> no_boletos = $request -> no_boletos;
        $orden -> precio_boleto = $request -> subtotal;
        $orden -> cupon = $request -> cupon;
        $orden -> cupon_tipo = $request -> cupon_tipo;
        $orden -> cupon_valor = $request -> cupon_valor;
        $orden -> descuento = $request -> descuento;
        $orden -> pago_metodo = $request -> metodo_pago;
        $orden -> status = 1;
        $orden->save();
        if($this -> validarDisponibilidadLugares($orden -> id, $request -> precio_id)){
            $orden -> status = 2;
            $orden -> save();
            return redirect()->back()->with('success', 'La orden se ha creado con exito');
        }else{
            $orden -> delete();
            return redirect()->back()->withInput()->with('error', 'La cantidad de boletos solicitada sobrepasa la disponibilidad actual');
        }
    }

    function validarDisponibilidadLugares($id_orden, $precio_id){
        $orden = Orden::find($id_orden);
        OrdenPerAsiento::where('orden_id', $id_orden)->delete();
        //Recuperamos todos los asientos por el precio seleccionado
        $asientos_per_precio = Asiento::select(['asiento.*', 'evento_precios.precio', 'evento_precios.comision'])
            ->join('precio_per_asiento', 'precio_per_asiento.asiento_id', '=', 'asiento.id')
            ->join('evento_precios', 'evento_precios.id', '=', 'precio_per_asiento.precio_id')
            ->where('asiento.evento_id', $orden -> evento_id)
            ->where('evento_precios.id', $precio_id)->get();

        //Aqui guardaremos los IDS que esten disponibles aun
        $asientos_disponibles = [];
        //dd($asientos_per_precio);
        //Recorremos esos haciendos validando cuales ya no estan disponibles
        foreach ($asientos_per_precio as $asiento){
            //verificacmos los asientos que no esten ocupados en el horario seleccionado
            if(!OrdenPerAsiento::join('orden', 'orden.id', '=', 'orden_per_asiento.orden_id')->where('orden.horario_id', $orden -> horario_id) -> where('orden.evento_id', $orden-> evento_id) -> whereIn('orden.status', [2,4])->where('asiento_id', $asiento -> id)->exists()){
                //Si no existe, guardamos el ID en el arreglo
                array_push($asientos_disponibles,  ['asiento_id' => $asiento->id, 'precio' => (($asiento -> precio * $asiento -> comsion) / 100) + $asiento -> precio]);
            }
        }
        //Verificamos que existan lugares disponibles
        if(count($asientos_disponibles)){
            //Verificamos que la solicitud de boletos no supere los asientos disponibles
            if($orden -> no_boletos > count($asientos_disponibles)){
                return false;
            }else{
                foreach ($asientos_disponibles as $i => $as){
                    if(($i+1) <= $orden -> no_boletos){
                        //Asignamos los asientos a la orden
                        OrdenPerAsiento::insert([
                            'asiento_id' => $as['asiento_id'],
                            'precio' => $as['precio'],
                            'orden_id' => $orden -> id
                        ]);
                    }else{
                        break;
                    }
                }
                return true;
            }
        }else{
            return false;
        }
    }

    public function download($orden_id){
        $orden = Orden::find($orden_id);
        $orden -> fecha_string = self::formatedDate($orden -> dia);
        $orden -> status_string = self::getStatus($orden -> status);
        $orden -> pago_hora_string = self::formatedDateHora($orden -> pago_hora);

        $orden -> asientos = OrdenPerAsiento::select(['asiento.folio', 'asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden_id)->get();

        $subtotal = $orden -> precio_boleto * $orden -> no_boletos;
        $orden -> subtotal = number_format($subtotal,2);
        $total = $subtotal - $orden -> descuento;
        $orden -> total = number_format($total,2);
        $evento = Evento::find($orden -> evento_id);
        $data = [
            'orden' => $orden,
            'evento' => $evento
        ];

        return \PDF::loadView('pdf/boleto', $data)
            ->stream('archivo.pdf');
    }

    public function download_view($orden_id){
        $orden = Orden::find($orden_id);
        $orden -> fecha_string = self::formatedDate($orden -> dia);
        $orden -> status_string = self::getStatus($orden -> status);
        $orden -> pago_hora_string = self::formatedDateHora($orden -> pago_hora);

        $orden -> asientos = OrdenPerAsiento::select(['asiento.folio', 'asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden_id)->get();

        $subtotal = $orden -> precio_boleto * $orden -> no_boletos;
        $orden -> subtotal = number_format($subtotal,2);
        $total = $subtotal - $orden -> descuento;
        $orden -> total = number_format($total,2);
        $evento = Evento::find($orden -> evento_id);
        $data = [
            'orden' => $orden,
            'evento' => $evento
        ];

        return view('pdf/boleto', $data);
    }



    static public function getStatus($status){
        if($status == 0){
            return '<span class="badge badge-info">Creado</span>';
        }else if($status == 1){
            return '<span class="badge badge-primary">Espera</span>';
        }else if($status == 2){
            return '<span class="badge badge-danger">Pagado</span>';
        }else if($status == 4){
            return '<span class="badge badge-warning">Espera Pago </span>';
        }else if($status == 5){
            return '<span class="badge badge-warning">Pago incompleto </span>';
        }else{
            return '<span class="badge badge-dark">Error de pago</span>';
        }
    }

    static public function formatedDate($date){
        $johnDateFactory = new Factory([
            'locale' => 'es_MX',
            'timezone' => 'America/merida',
        ]);
        $gameStart = Carbon::parse($date, 'UTC');
        return $johnDateFactory->make($gameStart)->isoFormat('DD MMMM YYYY');
    }

    static public function formatedDateHora($date){
        $johnDateFactory = new Factory([
            'locale' => 'es_MX',
            'timezone' => 'America/merida',
        ]);
        $gameStart = Carbon::parse($date, 'UTC');
        return $johnDateFactory->make($gameStart)->isoFormat('DD MMMM YYYY hh:mm A');
    }
}
