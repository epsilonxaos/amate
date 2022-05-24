<?php

namespace App\Http\Controllers;

use App\Asiento;
use App\Concurso;
use App\Documental;
use App\Evento;
use App\EventoCategoria;
use App\EventoHorario;
use App\EventoPrecio;
use App\Galeria;
use App\Gira;
use App\Mail\AliadoMail;
use App\Mail\ContactoMail;
use App\Mail\PagoCompletadoStaff;
use App\Mail\PostulanteMail;
use App\Noticia;
use App\Orden;
use App\OrdenPerAsiento;
use App\Pieza;
use App\PiezaContenido;
use App\Taller;
use Carbon\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Jenssegers\Optimus\Optimus;
use phpDocumentor\Reflection\Types\Self_;

class FrontController extends Controller
{
    public function index(Optimus $optimus) {
        $concurso = Concurso::where('status', 1)->first();
        if(Concurso::where('status', 1)->exists()){
            $concurso -> id = $optimus -> encode($concurso -> id);
            $concurso -> url_amigable = Str::slug($concurso -> titulo);
            $concurso -> fecha = OrdenController::formatedDate($concurso -> fecha);
        }
        $noticia = Noticia::orderBy('id','DESC')->limit('3')->get();
        foreach ($noticia as $n){
            $n -> id = $optimus->encode($n -> id);
            $n -> url_amigable = Str::slug($n -> titulo);
            $n -> s_desc = Str::limit(strip_tags($n -> descripcion), 150, '...');
            $n -> f_format = OrdenController::formatedDate($n->created_at);
        }
        return view('pages.index', ['concurso' => $concurso, 'noticias' => $noticia]);
    }
    public function nosotros_quienes_somos(){
        $path = resource_path('js/json/nosotros/linea_tiempo.json');
        $content = json_decode(file_get_contents($path), true);

        return view('pages.nosotros.quienes_somos', ["linea" => $content]);
    }
    public function nosotros_mumurantes(){
        $path = resource_path('js/json/nosotros/los_murmurantes.json');
        $content = json_decode(file_get_contents($path), true);

        return view('pages.nosotros.los_murmurantes', ["equipo" => $content]);
    }
    public function nosotros_mumurantes_detalle($url){
        $path = resource_path('js/json/nosotros/los_murmurantes.json');
        $content = json_decode(file_get_contents($path), true);

        $info = '';
        foreach ($content as $num => $temp) {
            if($temp['url'] == $url){
                $info = $temp;
            }
        }

        return view('pages.nosotros.los_murmurantes_detalle', ['equipo' => $info, "integrantes" => $content]);
    }
    public function nosotros_reconocimientos(){
        $path = resource_path('js/json/nosotros/comentarios.json');
        $content = json_decode(file_get_contents($path), true);

        return view('pages.nosotros.reconocimientos', ["comentarios" => $content]);
    }
    public function nosotros_aliados_culturales(){
        return view('pages.nosotros.aliados_culturales');
    }
    public function laboratorio_laboratorio(){
        return view('pages.laboratorio.laboratorio');
    }
    public function laboratorio_talleres(Optimus $optimus){
        /*$path = resource_path('js/json/laboratorio/talleres.json');
        $content = json_decode(file_get_contents($path), true);*/
        $talleres = Taller::where('status', 1)->paginate(9);
        foreach ($talleres as $t){
            $t -> id = $optimus->encode($t-> id);
            $t -> url_amigable = Str::slug($t-> titulo);
        }

        return view('pages.laboratorio.talleres', ["talleres" => $talleres]);
    }
    public function laboratorio_talleres_detalle($id, Optimus $optimus){
        /*$path = resource_path('js/json/laboratorio/talleres.json');
        $content = json_decode(file_get_contents($path), true);

        $info = '';
        foreach ($content as $num => $temp) {
            if($temp['url'] == $url){
                $info = $temp;
            }
        }*/
        $id = $optimus -> decode($id);
        $taller = Taller::find($id);
        $galerias = Galeria::where('tipo', 1)->where('rel_id', $id)->get();

        return view('pages.laboratorio.talleres_detalle', ["taller" => $taller, 'galerias' => $galerias]);
    }
    public function artes_piezas(Optimus $optimus){
        /*$path = resource_path('js/json/artes/piezas_escenicas.json');
        $content = json_decode(file_get_contents($path), true);*/
        $piezas = Pieza::where('status', 1)->paginate(9);
        foreach ($piezas as $p){
            $p -> id = $optimus->encode($p-> id);
            $p -> url_amigable = Str::slug($p-> titulo);
        }
        return view('pages.artes.piezas', ["piezas" => $piezas]);
    }
    public function artes_piezas_detalle($id, Optimus $optimus){
        $id = $optimus -> decode($id);
        $pieza = Pieza::find($id);
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',2)->get();
        $pieza_contenido = PiezaContenido::where('pieza_id', $id)->get();
        /*$path = resource_path('js/json/artes/piezas_escenicas.json');
        $content = json_decode(file_get_contents($path), true);

        $info = '';
        foreach ($content as $num => $temp) {
            if($temp['url'] == $url){
                $info = $temp;
            }
        }*/

        return view('pages.artes.piezas_detalle', ["pieza" => $pieza, 'galerias' => $galeria, 'contenido' => $pieza_contenido]);
    }
    public function artes_giras(Optimus $optimus){
       /* $path = resource_path('js/json/artes/giras.json');
        $content = json_decode(file_get_contents($path), true);*/
        $giras = Gira::where('status', 1)->paginate(9);
        foreach ($giras as $p){
            $p -> id = $optimus->encode($p-> id);
            $p -> url_amigable = Str::slug($p-> titulo);
        }
        return view('pages.artes.giras', ["giras" => $giras]);
    }
    public function artes_giras_detalle($id, Optimus $optimus){
        $id = $optimus -> decode($id);
        $gira = Gira::find($id);
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',3)->get();
       /* $path = resource_path('js/json/artes/giras.json');
        $content = json_decode(file_get_contents($path), true);

        $info = '';
        foreach ($content as $num => $temp) {
            if($temp['url'] == $url){
                $info = $temp;
            }
        }*/

        return view('pages.artes.giras_detalle', ["gira" => $gira, 'galerias' => $galeria]);
    }
    public function cine_documentales(Optimus $optimus){
        /*$path = resource_path('js/json/cine/documentales.json');
        $content = json_decode(file_get_contents($path), true);*/

        $documental = Documental::where('status', 1)->paginate(9);
        foreach ($documental as $p){
            $p -> id = $optimus->encode($p-> id);
            $p -> url_amigable = Str::slug($p-> titulo);
        }
        return view('pages.cine.documentales', ["documentales" => $documental]);
    }
    public function cine_documentales_detalle($id, Optimus $optimus){
        /*$path = resource_path('js/json/cine/documentales.json');
        $content = json_decode(file_get_contents($path), true);

        $info = '';
        foreach ($content as $num => $temp) {
            if($temp['url'] == $url){
                $info = $temp;
            }
        }*/
        $id = $optimus->decode($id);
        $documental = Documental::find($id);
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',4)->get();
        return view('pages.cine.documentales_detalle', ["documental" => $documental, 'galerias' => $galeria]);
    }
    public function cine_cineclub(){
        return view('pages.cine.cineclub');
    }
    public function blog(Optimus $optimus){
        /*$path = resource_path('js/json/blog/blog.json');
        $content = json_decode(file_get_contents($path), true);*/

        $noticia = Noticia::where('status', 1)->paginate(9);
        foreach ($noticia as $p){
            $p -> id = $optimus->encode($p-> id);
            $p -> url_amigable = Str::slug($p-> titulo);
            $p -> s_desc = Str::limit(strip_tags($p -> descripcion), 150, '...');
            $p -> f_format = OrdenController::formatedDate($p->created_at);
        }

        return view('pages.blog.blog', ["notas" => $noticia]);
    }
    public function blog_detalle($id, Optimus $optimus){
        /*$path = resource_path('js/json/blog/blog.json');
        $content = json_decode(file_get_contents($path), true);

        $info = '';
        foreach ($content as $num => $temp) {
            if($temp['url'] == $url){
                $info = $temp;
            }
        }*/

        $id = $optimus->decode($id);
        $noticia = Noticia::find($id);

        $similares = Noticia::where('status', 1)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(3)->get();
        foreach ($similares as $n){
            $n -> id = $optimus -> encode($n -> id);
            $n -> url_amigable = Str::slug($n -> titulo);
            $n -> s_desc = Str::limit(strip_tags($n -> descripcion), 150, '...');
            $n -> f_format = OrdenController::formatedDate($n->created_at);
        }

        return view('pages.blog.blog_detalle', ["nota" => $noticia, "similares" => $similares]);
    }
    public function contacto(){
        return view('pages.contacto');
    }
    public function concursos(Optimus $optimus){
        $concursos = Concurso::where('status',1)->get();
        foreach ($concursos  as $concurso){
            $concurso -> id = $optimus -> encode($concurso -> id);
            $concurso -> url_amigable = Str::slug($concurso-> titulo);
            $concurso -> fecha = OrdenController::formatedDate($concurso -> fecha);
            $concurso -> descripcion = strip_tags($concurso -> descripcion);
        }
        return view('pages.concursos.concurso', ['concursos' => $concursos]);
    }
    public function concursos_detalle($id, Optimus $optimus){
        $id = $optimus -> decode($id);
        $concurso = Concurso::find($id);
        $video_type = self::videoType($concurso -> link);
        $concurso -> embed = self::embedVideo($concurso -> link, $video_type);
        $galerias = Galeria::where('rel_id', $id)->where('tipo',5)->get();

        return view('pages.concursos.consurso_detalle', ['concurso' => $concurso, 'galerias' => $galerias]);
    }
    public function eventos(Optimus $optimus){
        $eventos = Evento::from('evento as ev')
            -> select('ev.*', 'evh.fecha as fechaEvento', 'evh.hora as horaEvento', 'evp.precio as precioEvento', 'evc.titulo as categoriaEvento')
            -> leftJoin('evento_horarios as evh', 'ev.id', '=', 'evh.evento_id')
            -> leftJoin('evento_precios as evp', 'ev.id', '=', 'evp.evento_id')
            -> leftJoin('evento_categorias as evc', 'ev.categoria_id', '=', 'evc.id')
            -> where([
                ['ev.status', '=', 1],
                ['evc.status', '=', 1]
            ])
            -> whereDate('evh.fecha', '>=', Carbon::now() -> format('Y-m-d'))
            // -> whereTime('evh.hora' , '>', Carbon::now() -> format('H:i:s'))
            -> orderBy('evh.fecha', 'ASC') -> paginate(12);

        // dd(Carbon::now() -> format('Y-m-d'), Carbon::now() -> format('H:i:s'), $eventos);

        foreach ($eventos as $pr){
            $pr -> id = $optimus -> encode($pr -> id);
            $pr -> url_amigable = Str::slug($pr -> titulo);
        }

        $eventoCategorias = EventoCategoria::from('evento_categorias as evc')
            -> select('evc.*')
            -> join('evento as ev', 'evc.id', '=', 'ev.categoria_id')
            -> where([
                ['ev.status', '=', 1],
                ['evc.status', '=', 1]
            ])
            -> groupBy('evc.id')
            -> orderBy('evc.orden', 'ASC') -> get();


        $now    = Date::parse('today') -> format('Y-m-d');
        $future = Date::parse("+7 days") -> format('Y-m-d');
        $params = Evento::from('evento as ev')
            -> select('ev.*', 'evh.fecha as fechaEvento', 'evh.hora as horaEvento', 'evp.precio as precioEvento', 'evc.id as idCategoriaEvento', 'evc.titulo as categoriaEvento')
            -> leftJoin('evento_horarios as evh', 'ev.id', '=', 'evh.evento_id')
            -> leftJoin('evento_precios as evp', 'ev.id', '=', 'evp.evento_id')
            -> leftJoin('evento_categorias as evc', 'ev.categoria_id', '=', 'evc.id')
            -> whereRaw("evh.fecha >= CAST('".$now."' AS DATE) AND evh.fecha <= CAST('".$future."' AS DATE) ")
            -> where([
                ['ev.status', '=', 1],
                ['evc.status', '=', 1]
            ])
            -> orderBy('evh.fecha', 'ASC')
            -> get();

        foreach ($params as $pr){
            $pr -> id = $optimus -> encode($pr -> id);
            $pr -> url_amigable = Str::slug($pr -> titulo);
        }
        //dd(DB::getQueryLog());
        $fechas = [Date::parse('today')->format('d'),Date::parse("+6 days")->format('d')];
        $mes = Date::parse("+6 days")->format('F');
       

        $calendario =[
            [Date::now()->format('D'),Date::now()->format('d')],
            [Date::parse('+1 day')->format('D'),Date::parse('+1 day')->format('d')],
            [Date::parse('+2 day')->format('D'),Date::parse('+2 day')->format('d')],
            [Date::parse('+3 day')->format('D'),Date::parse('+3 day')->format('d')],
            [Date::parse('+4 day')->format('D'),Date::parse('+4 day')->format('d')],
            [Date::parse('+5 day')->format('D'),Date::parse('+5 day')->format('d')],
            [Date::parse('+6 day')->format('D'),Date::parse('+6 day')->format('d')],
        ];

        return view('pages.eventos', [
            'eventos' => $eventos,
            'calendario' => $calendario,
            'fechas' => $fechas,
            'mes' => $mes,
            'params' => $params,
            'categorias' => $eventoCategorias
        ]);
    }

    public function eventos_detalle($id, Optimus $optimus){
        $original_id = $id;
        $id          = $optimus -> decode($id);

        $evento       = Evento::find($id);
        $galeria      = Galeria::where('rel_id', $id) -> where('tipo',1)->get();
        $horarios     = Evento::find($id) -> horarios() -> groupBy('fecha') -> orderBy('fecha', 'ASC') -> first();

        // dd($galeria);
        $url_amigable = Str::slug($evento -> titulo);

        return view('pages.eventos_detalle', [
            'original_id'  => $original_id,
            'url_amigable' => $url_amigable,
            'evento'       => $evento,
            'galeria'      => $galeria,
            'horarios'     => $horarios
        ]);
    }

    public function eventos_butacas(Request $request, Optimus $optimus){
        if(!Session::exists('orden_id')){
            $orden = Orden::create(['evento_id'=>$request -> evento_id, 'horario_id' => $request -> horario_id]);
            $orden -> folio = $optimus->encode($orden->id);
            $horario = EventoHorario::find($request->horario_id);
            $orden -> dia = $horario->fecha;
            $orden -> hora = $horario->hora;
            $orden->save();
            Session::put('orden_id', $orden -> id);
            $info['evento_id'] = $optimus->encode($request -> evento_id);
            $info['horario_id'] = $optimus->encode($request -> horario_id);
            return redirect()->route('front.seleccion.lugares', $info);
        }else{
            $orden = Orden::find(Session::get('orden_id'));
            $orden -> evento_id = $request -> evento_id;
            $orden -> horario_id = $request -> horario_id;
            $horario = EventoHorario::find($request->horario_id);
            $orden -> dia = $horario->fecha;
            $orden -> hora = $horario->hora;
            $orden -> save();
            $info['evento_id'] = $optimus->encode($request -> evento_id);
            $info['horario_id'] = $optimus->encode($request -> horario_id);
            return redirect()->route('front.seleccion.lugares', $info);
        }

    }

    public function eventos_pago_boletos(Request $request, Optimus $optimus){
        if(!Session::exists('orden_id')){
            $orden = Orden::create(['evento_id'=>$request -> evento_id, 'horario_id' => $request -> horario_id]);
            $orden -> folio = $optimus->encode($orden->id);
            $horario = EventoHorario::find($request->horario_id);
            $orden -> dia = $horario->fecha;
            $orden -> hora = $horario->hora;
            $orden->save();
            Session::put('orden_id', $orden -> id);
            $info['evento_id'] = $optimus->encode($request -> evento_id);
            $info['horario_id'] = $optimus->encode($request -> horario_id);
            return redirect()->route('front.eventos.boletos.pago', $info);
        }else{
            $orden = Orden::find(Session::get('orden_id'));
            $orden -> evento_id = $request -> evento_id;
            $orden -> horario_id = $request -> horario_id;
            $horario = EventoHorario::find($request->horario_id);
            $orden -> dia = $horario->fecha;
            $orden -> hora = $horario->hora;
            $orden -> save();
            $info['evento_id'] = $optimus->encode($request -> evento_id);
            $info['horario_id'] = $optimus->encode($request -> horario_id);
            return redirect()->route('front.eventos.boletos.pago', $info);
        }

    }

    public function eventos_pago_boletos_view(){
        if(Session::exists('orden_id')){
            if(self::validateTimeSession(Session::get('orden_id'))) {

                $orden_id = Session::get('orden_id');
                $orden = Orden::find($orden_id);

                $precios = EventoPrecio::where('evento_id', $orden -> evento_id)->where('tipo', 1)->get();
                foreach ($precios  as $precio){
                    $precio -> precio_final = (($precio -> precio * $precio -> comision) / 100) + $precio -> precio;
                }

                $data['orden'] = $orden;
                $data['asientos'] = OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden_id)->get()->toArray();
                $data['evento'] = Evento::find($orden->evento_id);
                $data['horario'] = EventoHorario::find($orden->horario_id);
                $data['subtotal'] = OrdenPerAsiento::where('orden_id', $orden_id)->sum('precio');
                $data['precios'] = $precios;
                return view('pages.compra.pagoboleto', $data);
            }else{
                Session::forget('orden_id');
                return redirect()->route('front.eventos')->with('message', 'Tu tiempo se agoto porfavor intenta de nuevo');
            }
        }else{
            return redirect()->route('front.eventos')->with('message', 'Ha expirado la sesion por favor intente de nuevo');
        }
    }

    public function eventos_butacas_view($evento_id, $horario_id, Optimus $optimus){
        $original_evento_id = $evento_id;
        $original_horario_id = $horario_id;
        $evento_id_decoded = $optimus -> decode($evento_id);
        $horario_id_decoded = $optimus -> decode($horario_id);
        if(Session::exists('orden_id')){
            if(self::validateTimeSession(Session::get('orden_id'))){
                $orden = Orden::find(Session::get('orden_id'));
                $info['orden'] = $orden;
                //$asientos = Asiento::where('evento_id', $evento_id_decoded)->get();
                $asientos = Asiento::select(['asiento.id', 'asiento.rel_id', 'asiento.num', 'asiento.letra', 'asiento.status', 'evento_precios.precio'])
                    ->join('precio_per_asiento', 'precio_per_asiento.asiento_id',  '=', 'asiento.id')
                    ->join('evento_precios', 'evento_precios.id', '=', 'precio_per_asiento.precio_id')
                    ->where('asiento.evento_id', $evento_id_decoded)
                    ->get();
                foreach ($asientos as $as){
                    $as -> status = OrdenPerAsiento::join('orden', 'orden.id', '=', 'orden_per_asiento.orden_id')->where('orden.horario_id', $horario_id_decoded) -> where('orden.evento_id', $evento_id_decoded) -> whereIn('orden.status', [2,4])->where('asiento_id', $as -> id)->exists() ? 2 : $as -> status;
                }
                $info['asientos']   = $asientos;
                $info['evento_id']  = $original_evento_id;
                $info['horario_id'] = $original_horario_id;
                return view('pages.compra.lugares', $info);
            }else{
                Session::forget('orden_id');
                return redirect()->route('front.eventos')->with('message', 'Tu tiempo se agoto porfavor intenta de nuevo');
            }
        }else{
            return redirect()->route('front.eventos')->with('message', 'Ha expirado la sesion por favor intente de nuevo');
        }
    }

    public function eventos_pago(Request $request){
        if(Session::exists('orden_id')){
            if(self::validateTimeSession(Session::get('orden_id'))) {
                $orden_id = Session::get('orden_id');
                $asientos = explode(',', $request->asientos_selected);
                $precios = explode(',', $request->asientos_precio);
                OrdenPerAsiento::where('orden_id', $orden_id)->delete();
                foreach ($asientos as $i => $as) {
                    OrdenPerAsiento::create([
                        'orden_id' => Session::get('orden_id'),
                        'asiento_id' => $as,
                        'precio' => $precios[$i]
                    ]);
                }
                return redirect()->route('front.eventos.pago');
            }else{
                Session::forget('orden_id');
                return redirect()->route('front.eventos')->with('message', 'Tu tiempo se agoto porfavor intenta de nuevo');
            }
        }else{
            return redirect()->route('front.eventos')->with('message', 'Ha expirado la sesion por favor intente de nuevo');
        }
    }

    public function pago() {
        return view('pages.compra.pago');
    }

    public function eventos_pago_view(){
        if(Session::exists('orden_id')){
            if(self::validateTimeSession(Session::get('orden_id'))) {

                $orden_id = Session::get('orden_id');
                $orden = Orden::find($orden_id);
                $data['orden'] = $orden;
                $data['asientos'] = OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden_id)->get()->toArray();
                $data['evento'] = Evento::find($orden->evento_id);
                $data['horario'] = EventoHorario::find($orden->horario_id);
                $data['subtotal'] = OrdenPerAsiento::where('orden_id', $orden_id)->sum('precio');
                return view('pages.compra.pago', $data);
            }else{
                Session::forget('orden_id');
                return redirect()->route('front.eventos')->with('message', 'Tu tiempo se agoto porfavor intenta de nuevo');
            }
        }else{
            return redirect()->route('front.eventos')->with('message', 'Ha expirado la sesion por favor intente de nuevo');
        }
    }

    public function eventos_session_destroy(){
        Session::forget('orden_id');
        return view('pages.compra.expirado');
    }

    public function consultarFolio($id, Optimus $optimus){
        $original_id = $id;
        $id = $optimus->decode($id);
        $orden_id = $id;
        if(Orden::where('id', $id)->where('status', 2)->exists()){

            $orden = Orden::find($orden_id);
            $data['orden'] = $orden;
            $data['asientos'] = OrdenPerAsiento::select(['asiento.folio', 'asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden_id)->get();
            $data['evento'] = Evento::find($orden->evento_id);
            $data['fecha'] = self::ParseDate($orden -> dia);
            $subtotal =  OrdenPerAsiento::where('orden_id', $orden_id)->sum('precio');
            $data['subtotal'] = $subtotal;
            $data['descuento'] = $orden -> descuento;
            $data['total'] = $subtotal - $orden ->descuento;
            $data['exists'] = true;
            $data['busqueda'] = $original_id;
        }else{
            $data['busqueda'] = $original_id;
            $data['exists'] = false;
        }
        return view('pages.compra.folio', $data);
    }

    public function eventos_pago_completado($id, Optimus $optimus){
        Session::forget('orden_id');
        $id = $optimus->decode($id);
        $orden_id = $id;
        $orden = Orden::find($orden_id);
        $data['orden'] = $orden;
        $data['asientos'] = OrdenPerAsiento::select(['asiento.folio', 'asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden_id)->get();
        $data['evento'] = Evento::find($orden->evento_id);
        $data['fecha'] = self::ParseDate($orden -> dia);
        $subtotal =  OrdenPerAsiento::where('orden_id', $orden_id)->sum('precio');
        $data['subtotal'] = $subtotal;
        $data['descuento'] = $orden -> descuento;
        $data['total'] = $subtotal - $orden ->descuento;
        return view('pages.compra.thx', $data);
    }

    public function eventos_pago_ticket($id, Optimus $optimus){
        Session::forget('orden_id');
        $id = $optimus->decode($id);
        $orden_id = $id;
        $orden = Orden::find($orden_id);
        $data['orden'] = $orden;
        $data['asientos'] = OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden_id)->get()->toArray();
        $data['evento'] = Evento::find($orden->evento_id);
        $data['fecha'] = self::ParseDate($orden -> dia);
        $subtotal =  OrdenPerAsiento::where('orden_id', $orden_id)->sum('precio');
        $data['subtotal'] = $subtotal;
        $data['descuento'] = $orden -> descuento;
        $data['total'] = $subtotal - $orden ->descuento;
        $data['conekta_order'] = ConektaTarjeta::findOrder($orden -> pago_referencia);
        return view('pages.compra.ticket', $data);
    }

    public function eventoComprar($id, Optimus $optimus){
        $id = $optimus -> decode($id);
        $info['evento'] = Evento::find($id);
        $horarios = Evento::find($id)->horarios()->groupBy('fecha')->orderBy('fecha', 'ASC')->get();
        foreach ($horarios as $fecha){
            $johnDateFactory = new Factory([
                'locale' => 'es_MX',
                'timezone' => 'America/merida',
            ]);
            $gameStart = Carbon::parse($fecha -> fecha, 'UTC');
            $fecha -> fecha_formated = $johnDateFactory->make($gameStart)->isoFormat('DD MMMM YYYY');
        }
        $info['evento_horario'] = $horarios;
        $info['evento_precio'] = Evento::find($id)->precios()->orderBy('precio', 'ASC')->get();
        //Session::forget('orden_id');
        if(!Session::exists('orden_id')){
            $orden = Orden::create(['evento_id'=>$id]);
            $info['orden'] = $orden;
            Session::put('orden_id', $orden -> id);
        }else{
            $info['orden'] = Orden::find(Session::get('orden_id'));
        }

        return view('pages.eventos.pago', $info);
    }

    public function getHourByDay(Request $request){
        $horarios = Evento::find($request -> id)->horarios()->whereDate('fecha',$request -> day)->orderBy('fecha', 'ASC')->get();
        return response() ->json(['success' => true,'data' => $horarios]);
    }

    public function pagoSave(Request $request){
        if(Session::exists('orden_id')){
            $orden = Orden::find(Session::get('orden_id'));
            $orden -> evento_titulo = $request -> evento_titulo;
            $orden -> nombre_completo = $request -> nombre;
            $orden -> correo = $request -> email;
            $orden -> telefono = $request -> pago_telefono;
            $orden -> no_boletos = $request -> evento_tipo == 0 ? $request -> boletos : 1;
            $orden -> precio_boleto = $request -> evento_tipo == 0 ? $request -> precio_boleto : $request -> subtotal;
            $orden -> cupon = $request -> cupon;
            $orden -> cupon_tipo = $request -> cupon_tipo;
            $orden -> cupon_valor = $request -> cupon_valor;
            $orden -> descuento = $request -> descuento;
            $orden -> pago_metodo = $request -> metodo;
            $orden -> status = 1;
            $orden -> save();
            //dd($request -> precio_boleto);
            if($request -> evento_tipo == 0){
                $orden_controller = new OrdenController();
                if($orden_controller -> validarDisponibilidadLugares($orden -> id, $request -> precio_id)){
                    return response() ->json(['success' => true]);
                }else{
                    return response() ->json(['success' => false, 'msg' => 'La cantidad de boletos solicitada sobrepasa la disponibilidad actual']);
                }
            }else{
                $valid_asientos = $this -> validarDisponibilidadLugares();
                if($valid_asientos['response']){
                    return response() ->json(['success' => true]);
                }else{
                    $asientos_string = self::asientosToString($valid_asientos['asientos_ya_ocupados']);
                    return response() ->json(['success' => false, 'msg' => 'Los asientos: '.$asientos_string.' ya no estan disponibles, para poder continuar regrese a la seleccion de asientos.']);
                }
            }
        }else{
            return response() ->json(['success' => false, 'message' => 'La session ha expirado intenta de nuevo.']);
        }
    }

    function validarDisponibilidadLugares(){
        $id_orden = Session::get('orden_id');
        $orden = Orden::find($id_orden);

        $asientos_ocupados = OrdenPerAsiento::select(['orden_per_asiento.id','asiento.num', 'asiento.letra'])
            ->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')
            ->join('orden', 'orden.id', '=', 'orden_per_asiento.orden_id')
            ->where('orden.evento_id', $orden -> evento_id)->where('orden.horario_id', $orden -> horario_id)->where('orden.status', 2)->get();

        $flag = true;
        $asientos_no_disponibles = [];
        foreach ($asientos_ocupados as $asiento){
            if(OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $id_orden)->where('orden_per_asiento.asiento_id', $asiento->id)->exists()){
                $flag = false;
                array_push($asientos_no_disponibles, ['id' => $asiento->id, 'num' => $asiento->num, 'letra' => $asiento->letra]);
            }
        }
        return ['response' => $flag, 'asientos_ya_ocuapdos' => $asientos_no_disponibles];
    }

    public function freePayment(Optimus $optimus){
        if(Session::exists('orden_id')){
            $orden = Orden::find(Session::get('orden_id'));
            $orden -> pago_metodo = 'free';
            $orden -> status = 2;
            $orden -> pago_hora = date('Y-m-d H:i:s');
            $orden -> save();

            if($orden -> descuento > 0){
                $cupon = Cupon::where('titulo', $orden -> cupon)->first();
                $cupon -> usos = $cupon -> usos + 1;
                $cupon -> save();
            }
            $subtotal =  OrdenPerAsiento::where('orden_id', $orden->id)->sum('precio');
            $asientos = OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden->id)->get()->toArray();
            $data = [
                'orden' => $orden,
                'evento' => Evento::find($orden -> evento_id),
                'asientos' => FrontController::asientosToString($asientos),
                'no_asientos' => count($asientos),
                'fecha' => FrontController::ParseDate($orden -> dia),
                'subtotal' => $subtotal,
                'descuento' => $orden -> descuento,
                'total' => $subtotal - $orden ->descuento
            ];
            Mail::to($orden->correo)->send(new PagoCompletado($data));
            Mail::to('aguila-josue@hotmail.com')->send(new PagoCompletadoStaff($data, true));
            $data['id'] = $optimus -> encode(Session::get('orden_id'));
            Session::forget('orden_id');
            return redirect()->route('front.eventos.pago.completado', $data);
            //return redirect()->back()->with('message','Pago Completado correctamente');
        }else{
            return redirect()->route('front.eventos')->with('message', 'Ha expirado la sesion por favor intente de nuevo');
        }
    }

    public function ipn(Request $request){
        Mail::to('luisjcaamal@gmail.com') -> send(new test_webhook('entre'));
        $enable_sandbox = true;
        $ipn = new PaypalIPN();
        if ($enable_sandbox) {
            $ipn->useSandbox();
        }
        Mail::to('luisjcaamal@gmail.com') -> send(new test_webhook('entre_2'));
        //$verified = $ipn->verifyIPN();
        $verified = true;
        $body = @"";
        Mail::to('luisjcaamal@gmail.com') -> send(new test_webhook($request -> payment_status));
        if ($verified) {
            $payment_status = $request -> payment_status;
            $item_number = $request -> item_number;
            $orden = Orden::find($item_number);
            $orden -> pago_metodo = 'paypal';
            $orden -> save();
            switch ($payment_status){
                case 'Completed':
                    $orden -> status = 2;
                    $orden -> pago_hora = date('Y-m-d H:i:s');
                    $orden -> save();
                    if($orden -> descuento > 0){
                        $cupon = Cupon::where('titulo', $orden -> cupon)->first();
                        $cupon -> usos = $cupon -> usos + 1;
                        $cupon -> save();
                    }
                    $subtotal =  OrdenPerAsiento::where('orden_id', $orden->id)->sum('precio');
                    $asientos = OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden->id)->get()->toArray();
                    $data = [
                        'orden' => $orden,
                        'evento' => Evento::find($orden -> evento_id),
                        'asientos' => FrontController::asientosToString($asientos),
                        'no_asientos' => count($asientos),
                        'fecha' => FrontController::ParseDate($orden -> dia),
                        'subtotal' => $subtotal,
                        'descuento' => $orden -> descuento,
                        'total' => $subtotal - $orden ->descuento
                    ];
                    Mail::to($orden->correo)->send(new PagoCompletado($data));
                    Mail::to('aguila-josue@hotmail.com')->send(new PagoCompletadoStaff($data, true));
                    return response()->json("Orden actualizada.", 200);
                    break;
                case 'Denied':
                    break;
                case 'Processed':
                    break;
            }

        }
    }


    public function listLugares($evento_id){
        $asientos = Asiento::select(['asiento.id', 'asiento.rel_id', 'asiento.num', 'asiento.letra', 'asiento.status', 'evento_precio.precio'])
            ->join('precio_per_asiento', 'precio_per_asiento.asiento_id',  '=', 'asiento.id')
            ->join('evento_precio', 'evento_precio.id', '=', 'precio_per_asiento.precio_id')
            ->where('asiento.evento_id', $evento_id)
            ->get();
        return response() ->json(['success' => true, 'asientos' => $asientos]);
    }


    public function download($orden_id){
        $orden = Orden::find($orden_id);
        $orden -> fecha_string = self::ParseDate($orden -> dia);
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
            ->stream('boleto-'.$orden -> folio.'.pdf');
    }

    static public function videoType($url) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }

    static public function embedVideo($link = '', $type = ""){
        if($type == 'youtube'){
            $url = urldecode(rawurldecode($link));
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
            //$registro['idVideo'] = $matches[1];
            $embed  = 'https://www.youtube.com/embed/'.$matches[1].'';
        }else if($type == 'vimeo'){
            $_idVideo = (int) substr(parse_url($link, PHP_URL_PATH), 1);
            $embed  = 'https://player.vimeo.com/video/'.$_idVideo.'?color=696c6e&title=0&byline=0&portrait=0';
        }else{
            $embed  = '';
        }
        return $embed;
    }

    static public function ParseDate($date){
        $johnDateFactory = new Factory([
            'locale' => 'es_MX',
            'timezone' => 'America/merida',
        ]);
        $gameStart = Carbon::parse($date, 'UTC');
        return $johnDateFactory->make($gameStart)->isoFormat('DD MMMM YYYY');
    }

    static public function sumMinutes($date){
        return date('Y-m-d H:i:s', strtotime($date.'+10 minutes'));
    }

    static public function validateTimeSession($id){
        $now = Date::now();
        $orden = Orden::find($id);
        $life = Date::parse($orden -> created_at)->addMinutes(10);
        //dd($life);
        return $life > $now ? true : false;
    }

    static public function asientosToString($arr){
        $string = '';
        $total = count($arr);
        foreach ($arr as $i => $a){
            $signo = $i+1 == $total ? '' : ', ';
            $string .= $a['num'].$a['letra'].$signo;
        }
        return $string;
    }

}
