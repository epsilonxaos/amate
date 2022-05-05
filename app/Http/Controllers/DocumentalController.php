<?php

namespace App\Http\Controllers;

use App\Documental;
use App\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocumentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = [
            'title' => 'Documentales',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.documental.list',
                    'active' => true
                ]
            ],
            'buttons' => [
                [
                    'title' => 'Agregar Nuevo',
                    'route' => 'panel.documental.add'
                ]
            ]
        ];
        $info['data'] = Documental::get();
        return view('panel.documental.list', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = [
            'title' => 'Documentals',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.documental.list',
                ],
                [
                    'title' => 'Nuevo Documental',
                    'route' => 'panel.documental.add',
                    'active' => true
                ]
            ]
        ];
        return view('panel.documental.add', $info);
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
            'descripcion' => 'required',
            'portada' => 'required',
        ]);
        $documental = Documental::create([
            'titulo' => $request -> titulo,
            'descripcion' => $request -> descripcion,
            'descripcion_2' => $request -> descripcion_2,
            'status' => 1
        ]);
        if($documental -> id){
            if($request -> hasFile('portada')){
                $path_cover = $request->portada->store('public/documental');
                $_exploded = explode('/', $path_cover);
                $_exploded[0] = 'storage';
                $path_cover = implode('/', $_exploded);
                $documental -> portada = basename($path_cover);
                $documental -> save();
            }
            if($request->file('galeria')){
                foreach($request->file('galeria') as $image)
                {
                    $path_slide = $image->store('public/documental/galeria/');
                    $_exploded = explode('/', $path_slide);
                    $_exploded[0] = 'storage';
                    $path_slide = implode('/', $_exploded);
                    $galeria = Galeria::create([
                        'rel_id'=>$documental ->id,
                        'imagen'=> basename($path_slide),
                        'tipo'=>4,
                    ]);
                }
            }
        }
        return redirect()
            -> route('panel.documental.list')
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
        $documental = Documental::find($id);
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',4)->get();

        $info = [
            'title' => 'Documental',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.documental.list',
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.documental.edit',
                    'params' => ['id' => $id],
                    'active' => true
                ]
            ]
        ];

        $info['documental'] = $documental;
        $info['galeria'] = $galeria;
        return view('panel.documental.edit', $info);
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
            'descripcion'   => 'required',
        ]);

        $documental = Documental::find($id);
        $documental -> titulo    = $request -> titulo;
        $documental -> descripcion = $request -> descripcion;
        $documental -> descripcion_2 = $request -> descripcion_2;

        if($request -> hasFile('portada')){
            if(file_exists('storage/documental/'.$documental -> portada)){
                File::delete('storage/documental/'.$documental -> portada);
            }

            $path_cover = $request->portada->store('public/documental');
            $_exploded = explode('/', $path_cover);
            $_exploded[0] = 'storage';
            $path_cover = implode('/', $_exploded);
            $documental -> portada = basename($path_cover);
        }
        $documental -> save();

        if($request->file('galeria')){
            foreach($request->file('galeria') as $image)
            {
                $path_slide = $image->store('public/documental/galeria/');
                $_exploded = explode('/', $path_slide);
                $_exploded[0] = 'storage';
                $path_slide = implode('/', $_exploded);
                $galeria = Galeria::create([
                    'rel_id'=>$documental ->id,
                    'imagen'=> basename($path_slide),
                    'tipo'=>4,
                ]);
            }
        }

        if($request->file('galeria_upd')){
            foreach($request->file('galeria_upd') as $i => $image)
            {
                $galeria = Galeria::find($request['galeria_id'][$i]);
                if(file_exists('storage/documental/galeria/'.$galeria -> imagen)){
                    File::delete('storage/documental/galeria/'.$galeria -> imagen);
                }
                $path_slide = $image->store('public/documental/galeria/');
                $_exploded = explode('/', $path_slide);
                $_exploded[0] = 'storage';
                $path_slide = implode('/', $_exploded);
                $galeria -> imagen = basename($path_slide);
                $galeria -> save();
            }
        }



        return redirect()
            -> route('panel.documental.list')
            -> with('message', 'Se ha modificado el registro correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documental = Documental::find($id);
        if(file_exists('storage/documental/'.$documental -> portada)){
            File::delete('storage/documental/'.$documental -> portada);
        }
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',4)->get();
        if(count($galeria)){
            foreach ($galeria as $gal){
                if(file_exists('storage/documental/galeria/'.$gal->imagen)){
                    File::delete('storage/documental/galeria/'.$gal->imagen);
                }
                Galeria::find($gal -> id) -> delete();
            }
        }
        $documental -> delete();
        return response(['success' => true], 200);
    }

    public function changeStatus($id, Request $request){
        $documental = Documental::find($id);
        $documental -> status = $request -> status == 'hidden' ? 0 : 1;
        $documental -> save();
        return response(['success' => true], 200);
    }
}
