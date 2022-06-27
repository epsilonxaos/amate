<?php

namespace App\Http\Controllers;

use App\Asiento;
use App\Evento;
use App\EventoCategoria;
use App\EventoHorario;
use App\EventoPrecio;
use App\Exports\HorarioExport;
use App\Galeria;
use App\Helpers;
use App\Imports\AsientoImport;
use App\PrecioPerAsiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class EventoController extends Controller
{
    protected $directorio = "public/evento";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = [
            'title' => 'Eventos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.evento.list',
                    'active' => true
                ]
            ],
            'buttons' => [
                [
                    'title' => 'Agregar Nuevo',
                    'route' => 'panel.evento.add'
                ]
            ]
        ];
        $info['data'] = Evento::get();
        return view('panel.evento.list', $info);
    }

    public function lugares($evento_id)
    {
        $info = [
            'title' => 'Eventos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.evento.list',
                    'active' => false
                ],
                [
                    'title' => 'Importar Lugares',
                    'route' => 'panel.evento.lugares',
                    'params' => ['evento_id' => $evento_id],
                    'active' => true
                ],

            ],
        ];
        $info['data'] = Asiento::where('evento_id', $evento_id)->get();
        $info['evento_id'] = $evento_id;
        return view('panel.evento.importar', $info);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = [
            'title' => 'Eventos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.evento.list',
                ],
                [
                    'title' => 'Nueva Evento',
                    'route' => 'panel.evento.add',
                    'active' => true
                ]
            ]
        ];
        
        $evento_categorias = EventoCategoria::where('status', 1) -> get();

        $info['evento_categoria'] = $evento_categorias;
        return view('panel.evento.add', $info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'titulo' => 'required',
            'lugar' => 'required',
            'descripcion' => 'required',
            'portada' => 'required',
        ]);
        $evento = Evento::create([
            'titulo' => $request -> titulo,
            'tipo'   => $request -> tipo,
            'categoria_id'   => $request -> categoria_id,
            'lugar' => $request -> lugar,
            'latitud' => $request -> latitud,
            'longitud' => $request -> longitud,
            'descripcion' => $request -> descripcion,
            'descripcion_2' => $request -> descripcion_2,
            'status' => 0
        ]);
        if($evento -> id){
            if($request -> hasFile('portada')){
                $path_cover = $request->portada->store('public/evento');
                $_exploded = explode('/', $path_cover);
                $_exploded[0] = 'storage';
                $path_cover = implode('/', $_exploded);
                $evento -> portada = basename($path_cover);
                $evento -> save();
            }
            if($request -> hasFile('imagen_1')) {
                $img = Helpers::addFileStorage($request -> file('imagen_1'), $this -> directorio);
                $evento -> imagen_lateral_1 = $img;
                $evento -> save();
            }
            if($request -> hasFile('imagen_2')) {
                $img = Helpers::addFileStorage($request -> file('imagen_2'), $this -> directorio);
                $evento -> imagen_lateral_2 = $img;
                $evento -> save();
            }
            if($request -> hasFile('imagen_2')) {
                $img = Helpers::addFileStorage($request -> file('imagen_3'), $this -> directorio);
                $evento -> imagen_lateral_3 = $img;
                $evento -> save();
            }
            if($request->file('galeria')){
                foreach($request->file('galeria') as $image)
                {
                    $path_slide = $image->store('public/evento/galeria/');
                    $_exploded = explode('/', $path_slide);
                    $_exploded[0] = 'storage';
                    $path_slide = implode('/', $_exploded);
                    $galeria = Galeria::create([
                        'rel_id'=>$evento ->id,
                        'imagen'=> basename($path_slide),
                        'tipo'=>1,
                    ]);
                }
            }
            if($request->has('new_content_id')){
                foreach ($request->input('new_content_id') as $k => $id){
                    EventoHorario::create([
                        'evento_id' => $evento->id,
                        'fecha' => $request->input('fecha-dia')[$id],
                        'hora' => $request->input('fecha-hora')[$id],
                        'cupo' => $request->input('fecha-cupo')[$id],
                        'status' => 1
                    ]);
                }
            }
            if($request->has('new_content_precio_id')){
                foreach ($request->input('new_content_precio_id') as $k => $id){
                    EventoPrecio::create([
                        'evento_id' => $evento->id,
                        'concepto' => $request->input('precio-concepto')[$id],
                        'tipo' => $request->input('precio-tipo')[$id],
                        'precio' => $request->input('precio-costo')[$id],
                        'comision' => $request->input('precio-comision')[$id]
                    ]);
                }
            }
        }
        return redirect()
            -> route('panel.evento.list')
            -> with('message', 'Se ha creado el registro correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = Evento::find($id);
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',1)->get();
        $evento_categorias = EventoCategoria::where('status', 1) -> get();

        $info = [
            'title' => 'Evento',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.evento.list',
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.evento.edit',
                    'params' => ['id' => $id],
                    'active' => true
                ]
            ]
        ];

        $info['evento'] = $evento;
        $info['evento_categoria'] = $evento_categorias;
        $info['galeria'] = $galeria;
        $info['evento_horario'] = Evento::find($id)->horarios;
        $info['evento_precio'] = Evento::find($id)->precios;
        $info['evento_asientos'] = Evento::find($id)->asientos->where('status', 1);
        return view('panel.evento.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'titulo'        => 'required',
            'lugar'        => 'required',
            'descripcion'   => 'required',
        ]);

        $evento = Evento::find($id);
        $evento -> titulo           = $request -> titulo;
        $evento -> tipo             = $request -> tipo;
        $evento -> categoria_id     = $request -> categoria_id;
        $evento -> lugar            = $request -> lugar;
        $evento -> latitud          = $request -> latitud;
        $evento -> longitud         = $request -> longitud;
        $evento -> descripcion      = $request -> descripcion;
        $evento -> descripcion_2    = $request -> descripcion_2;

        if($request -> hasFile('portada')){
            if(file_exists('storage/evento/'.$evento -> portada)){
                File::delete('storage/evento/'.$evento -> portada);
            }

            $path_cover = $request->portada->store('public/evento');
            $_exploded = explode('/', $path_cover);
            $_exploded[0] = 'storage';
            $path_cover = implode('/', $_exploded);
            $evento -> portada = basename($path_cover);
        }

        if($request -> hasFile('imagen_1')) {
            Helpers::deleteFileStorage('evento', 'imagen_lateral_1', $id);
            $img1 = Helpers::addFileStorage($request -> file('imagen_1'), $this -> directorio);
            $evento -> imagen_lateral_1 = $img1;
        }
        if($request -> hasFile('imagen_2')) {
            Helpers::deleteFileStorage('evento', 'imagen_lateral_2', $id);
            $img2 = Helpers::addFileStorage($request -> file('imagen_2'), $this -> directorio);
            $evento -> imagen_lateral_2 = $img2;
        }
        if($request -> hasFile('imagen_2')) {
            Helpers::deleteFileStorage('evento', 'imagen_lateral_3', $id);
            $img3 = Helpers::addFileStorage($request -> file('imagen_3'), $this -> directorio);
            $evento -> imagen_lateral_3 = $img3;
        }

        $evento -> save();

        if($request->file('galeria')){
            foreach($request->file('galeria') as $image)
            {
                $path_slide = $image->store('public/evento/galeria/');
                $_exploded = explode('/', $path_slide);
                $_exploded[0] = 'storage';
                $path_slide = implode('/', $_exploded);
                $galeria = Galeria::create([
                    'rel_id'=>$evento ->id,
                    'imagen'=> basename($path_slide),
                    'tipo'=>1,
                ]);
            }
        }
        if($request->file('galeria_upd')){
            foreach($request->file('galeria_upd') as $i => $image)
            {
                $galeria = Galeria::find($request['galeria_id'][$i]);
                if(file_exists('storage/evento/galeria/'.$galeria -> imagen)){
                    File::delete('storage/evento/galeria/'.$galeria -> imagen);
                }
                $path_slide = $image->store('public/evento/galeria/');
                $_exploded = explode('/', $path_slide);
                $_exploded[0] = 'storage';
                $path_slide = implode('/', $_exploded);
                $galeria -> imagen = basename($path_slide);
                $galeria -> url = $request -> url[$i];
                $galeria -> save();
            }
        }

        foreach($request -> url as $i => $image)
        {
            $galeria = Galeria::find($request['galeria_id'][$i]);
            
            $galeria -> url = $request -> url[$i];
            $galeria -> save();
        }

        if($request->has('new_content_id')){
            foreach ($request->input('new_content_id') as $k => $id){
                EventoHorario::create([
                    'evento_id' => $evento -> id,
                    'hora' => $request->input('fecha-hora')[$id],
                    'fecha' => $request->input('fecha-dia')[$id],
                    'cupo' => $request->input('fecha-cupo')[$id],
                    'status' => 1
                ]);
            }
        }

        if($request->has('old_content_id')){
            foreach ($request->input('old_content_id') as $k => $id){
                $pieza_contenido = EventoHorario::find($id);
                $pieza_contenido -> hora = $request->input('fecha-hora-upd')[$id];
                $pieza_contenido -> fecha = $request->input('fecha-dia-upd')[$id];
                $pieza_contenido -> cupo = $request->input('fecha-cupo-upd')[$id];
                $pieza_contenido -> save();
            }
        }

        if($request->has('new_content_precio_id')){
            foreach ($request->input('new_content_precio_id') as $k => $id){
                EventoPrecio::create([
                    'evento_id' => $evento->id,
                    'concepto' => $request->input('precio-concepto')[$id],
                    'tipo' => $request->input('precio-tipo')[$id],
                    'comision' => $request->input('precio-comision')[$id],
                    'precio' => $request->input('precio-costo')[$id]
                ]);
            }
        }

        if($request->has('old_content_precio_id')){
            foreach ($request->input('old_content_precio_id') as $k => $id){
                $pieza_contenido = EventoPrecio::find($id);
                $pieza_contenido -> concepto = $request->input('precio-concepto-upd')[$id];
                $pieza_contenido -> tipo = $request->input('precio-tipo-upd')[$id];
                $pieza_contenido -> comision = $request->input('precio-comision-upd')[$id];
                $pieza_contenido -> precio = $request->input('precio-costo-upd')[$id];
                $pieza_contenido -> save();
            }
        }


        return redirect()
            -> route('panel.evento.list')
            -> with('message', 'Se ha modificado el registro correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function addPrecioPerAsiento(Request $request){
        PrecioPerAsiento::where('precio_id', $request -> precio_id)->delete();
        foreach ($request -> input('asiento_id') as $id){
            PrecioPerAsiento::create([
               'precio_id' => $request -> precio_id,
               'asiento_id' => $id
            ]);
        }
        return redirect() -> back() -> with('message', 'Se han asignado los precios correctamente');;
    }

    static public function listAsientosPerPrecio($precio_id){
        $asientos_asignados = PrecioPerAsiento::select('asiento.num', 'asiento.letra')->join('asiento', 'asiento.id', '=', 'precio_per_asiento.asiento_id')->where('precio_per_asiento.precio_id', $precio_id)->get();
        $asientos = [];
        foreach ($asientos_asignados as $asiento){
            array_push($asientos, $asiento->num.''.$asiento->letra);
        }
        return implode(',', $asientos);
    }

    public function destroy($id)
    {
        $evento = Evento::find($id);
        if(file_exists('storage/evento/'.$evento -> portada)){
            File::delete('storage/evento/'.$evento -> portada);
        }
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',1)->get();
        if(count($galeria)){
            foreach ($galeria as $gal){
                if(file_exists('storage/evento/galeria/'.$gal->imagen)){
                    File::delete('storage/evento/galeria/'.$gal->imagen);
                }
                Galeria::find($gal -> id) -> delete();
            }
        }

        $evento_horario = EventoHorario::where('evento_id', $id)->get();
        foreach ($evento_horario as $h){
            $h -> delete();
        }

        $evento_precio = EventoPrecio::where('evento_id', $id)->get();
        foreach ($evento_precio as $p){
            PrecioPerAsiento::where('precio_id', $p->id)->delete();
            $p -> delete();
        }

        $evento -> delete();
        return response(['success' => true], 200);
    }

    public function changeStatus($id, Request $request){
        $evento = Evento::find($id);
        $evento -> status = $request -> status == 'hidden' ? 0 : 1;
        $evento -> save();
        return response(['success' => true], 200);
    }

    public function changeDestacar($id, Request $request){
        $evento = Evento::find($id);
        $evento -> destacado = $request -> status == 'hidden' ? 0 : 1;
        $evento -> save();
        return response(['success' => true], 200);
    }

    public function changeStatusHorario($id, Request $request){
        $evento = EventoHorario::find($id);
        $evento -> status = $request -> status == 'hidden' ? 0 : 1;
        $evento -> save();
        return response(['success' => true], 200);
    }

    public function destroyGaleria($id){
        $galeria = Galeria::find($id);
        if(file_exists('storage/evento/galeria/'.$galeria->imagen)){
            File::delete('storage/evento/galeria/'.$galeria->imagen);
        }
        $galeria ->delete();
        return response(['success' => true], 200);
    }

    public function destroyPrecio($id){
        PrecioPerAsiento::where('precio_id', $id)->delete();
        EventoPrecio::find($id)->delete();
        return response(['success' => true], 200);
    }

    public function export($id){
        $evento = Evento::find($id);
        $evento -> url = Str::slug($evento->titulo);
        $hora = time();
        return Excel::download(new HorarioExport($id), 'horarios-evento-'.$evento->url.'-'.$hora.'.xlsx');
    }

    public function import(Request $request, $evento_id){
        Asiento::where('evento_id', $evento_id)->delete();
        Excel::import(new AsientoImport($evento_id), $request->file('excel'));
        return redirect()->back()->with('message', 'Se ha importado los asientos con éxito');
    }
}
