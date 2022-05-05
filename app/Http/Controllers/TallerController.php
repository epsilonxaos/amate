<?php

namespace App\Http\Controllers;

use App\Galeria;
use App\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = [
            'title' => 'Talleres',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.taller.list',
                    'active' => true
                ]
            ],
            'buttons' => [
                [
                    'title' => 'Agregar Nuevo',
                    'route' => 'panel.taller.add'
                ]
            ]
        ];
        $info['data'] = Taller::get();
        return view('panel.taller.list', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = [
            'title' => 'Taller',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.taller.list',
                ],
                [
                    'title' => 'Nuevo Taller',
                    'route' => 'panel.taller.add',
                    'active' => true
                ]
            ]
        ];
        return view('panel.taller.add', $info);
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
            'subtitulo' => 'required',
            'portada' => 'required',
        ]);
        $taller = Taller::create([
            'titulo' => $request -> titulo,
            'subtitulo' => $request -> subtitulo,
            'status' => 1
        ]);
        if($taller -> id){
            if($request -> hasFile('portada')){
                $path_cover = $request->portada->store('public/taller');
                $_exploded = explode('/', $path_cover);
                $_exploded[0] = 'storage';
                $path_cover = implode('/', $_exploded);
                $taller -> portada = basename($path_cover);
                $taller -> save();
            }
            if($request->file('galeria')){
                foreach($request->file('galeria') as $image)
                {
                    $path_slide = $image->store('public/taller/galeria/');
                    $_exploded = explode('/', $path_slide);
                    $_exploded[0] = 'storage';
                    $path_slide = implode('/', $_exploded);
                    $galeria = Galeria::create([
                        'rel_id'=>$taller ->id,
                        'imagen'=> basename($path_slide),
                        'tipo'=>1,
                    ]);
                }
            }
        }
        return redirect()
            -> route('panel.taller.list')
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
        $taller = Taller::find($id);
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',1)->get();

        $info = [
            'title' => 'Taller',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.taller.list',
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.taller.edit',
                    'params' => ['id' => $id],
                    'active' => true
                ]
            ]
        ];

        $info['taller'] = $taller;
        $info['galeria'] = $galeria;
        return view('panel.taller.edit', $info);
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
            'titulo'  => 'required',
            'subtitulo'        => 'required',
        ]);

        $taller = Taller::find($id);
        $taller -> titulo    = $request -> titulo;
        $taller -> subtitulo = $request -> subtitulo;

        if($request -> hasFile('portada')){
            if(file_exists('storage/taller/'.$taller -> portada)){
                File::delete('storage/taller/'.$taller -> portada);
            }

            $path_cover = $request->portada->store('public/taller');
            $_exploded = explode('/', $path_cover);
            $_exploded[0] = 'storage';
            $path_cover = implode('/', $_exploded);
            $taller -> portada = basename($path_cover);
        }
        $taller -> save();

        if($request->file('galeria')){
            foreach($request->file('galeria') as $image)
            {
                $path_slide = $image->store('public/taller/galeria/');
                $_exploded = explode('/', $path_slide);
                $_exploded[0] = 'storage';
                $path_slide = implode('/', $_exploded);
                $galeria = Galeria::create([
                    'rel_id'=>$taller ->id,
                    'imagen'=> basename($path_slide),
                    'tipo'=>1,
                ]);
            }
        }

        if($request->file('galeria_upd')){
            foreach($request->file('galeria_upd') as $i => $image)
            {
                $galeria = Galeria::find($request['galeria_id'][$i]);
                if(file_exists('storage/taller/galeria/'.$galeria -> imagen)){
                    File::delete('storage/taller/galeria/'.$galeria -> imagen);
                }
                $path_slide = $image->store('public/taller/galeria/');
                $_exploded = explode('/', $path_slide);
                $_exploded[0] = 'storage';
                $path_slide = implode('/', $_exploded);
                $galeria -> imagen = basename($path_slide);
                $galeria -> save();
            }
        }



        return redirect()
            -> route('panel.taller.list')
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
        $taller = Taller::find($id);
        if(file_exists('storage/taller/'.$taller -> portada)){
            File::delete('storage/taller/'.$taller -> portada);
        }
        $galeria = Galeria::where('rel_id', $id) -> where('tipo',1)->get();
        if(count($galeria)){
            foreach ($galeria as $gal){
                if(file_exists('storage/taller/galeria/'.$gal->imagen)){
                    File::delete('storage/taller/galeria/'.$gal->imagen);
                }
                Galeria::find($gal -> id) -> delete();
            }
        }
        $taller -> delete();
        return response(['success' => true], 200);
    }

    public function changeStatus($id, Request $request){
        $taller = Taller::find($id);
        $taller -> status = $request -> status == 'hidden' ? 0 : 1;
        $taller -> save();
        return response(['success' => true], 200);
    }
}
