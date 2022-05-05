<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use anlutro\LaravelSettings\Facade as Setting;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(){
        $info = [
            'title' => 'Configuración',
            'breadcrumb' => [
                [
                    'title' => 'SEO',
                    'route' => 'panel.settings.seo',
                ],
                [
                    'title' => 'Editar',
                    'active' => true
                ],
            ],
        ];
        return view('panel.settings.edit', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebook(){
        $info = [
            'title' => 'Configuración',
            'breadcrumb' => [
                [
                    'title' => 'SEO - Facebook',
                    'route' => 'panel.settings.seo',
                ],
                [
                    'title' => 'Editar',
                    'active' => true
                ],
            ],
        ];
        return view('panel.settings.facebook', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analytic(){
        $info = [
            'title' => 'Configuración',
            'breadcrumb' => [
                [
                    'title' => 'SEO - Analytics',
                    'route' => 'panel.settings.seo',
                ],
                [
                    'title' => 'Editar',
                    'active' => true
                ],
            ],
        ];
        return view('panel.settings.analytic', $info);
    }

    public function about(){
        $info = [
            'title' => 'Configuración - Nosotros',
            'breadcrumb' => [
                [
                    'title' => 'Sección Nosotros',
                    'route' => 'panel.settings.about',
                ],
                [
                    'title' => 'Editar',
                    'active' => true
                ],
            ],
        ];
        return view('panel.settings.about', $info);
    }

    public function update(Request $request){
        //Necesitamos los indices de la configuración
        $options = $request->toArray();
        // dd($request->file('xml'));
        if(isset($request->files)){
            foreach($request->files as $k => $file){
                //Actualizamos la ruta donde se guardó el archivo
                $options[$k] = $this->upload($request->file($k), 'public/seo');
            }
        }
        //Seteamos las opciones de configuración
        foreach($options as $key => $value){
            if(($key != '_token') && ($key != '_method')){
                Setting::set($key, $value);
            }
        }
        //Actualizamos
        Setting::save();
        return redirect()->back()->with('success', 'Información actualizada');
    }

    public static function upload($_file, $path){
        $path_file = $_file->store($path);
        $_exploded = explode('/', $path_file);
        $_exploded[0] = 'storage';
        $path_file = implode('/', $_exploded);
        return $path_file;
    }
}
