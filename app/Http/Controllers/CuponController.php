<?php

namespace App\Http\Controllers;

use App\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = [
            'title' => 'Cupones',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.cupon.list',
                    'active' => true
                ]
            ],
            'buttons' => [
                [
                    'title' => 'Agregar Nuevo',
                    'route' => 'panel.cupon.add'
                ]
            ]
        ];
        $info['data'] = Cupon::get();
        return view('panel.cupon.list', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = [
            'title' => 'Cupones',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.cupon.list',
                ],
                [
                    'title' => 'Nuevo Cupon',
                    'route' => 'panel.cupon.add',
                    'active' => true
                ]
            ]
        ];
        return view('panel.cupon.add', $info);
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
            'descuento' => 'required',
            'tipo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
            'limite' => 'required',
        ]);
        $cupon = Cupon::create([
            'titulo' => $request -> titulo,
            'descuento' => $request -> descuento,
            'tipo' => $request -> tipo,
            'fecha_inicio' => $request -> fecha_inicio,
            'fecha_termino' => $request -> fecha_termino,
            'limite' => $request -> limite,
            'status' => 1
        ]);
        return redirect()
            -> route('panel.cupon.list')
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
        $cupon = Cupon::find($id);

        $info = [
            'title' => 'Cupon',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.cupon.list',
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.cupon.edit',
                    'params' => ['id' => $id],
                    'active' => true
                ]
            ]
        ];

        $info['cupon'] = $cupon;
        return view('panel.cupon.edit', $info);
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
            'titulo' => 'required',
            'descuento' => 'required',
            'tipo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
            'limite' => 'required',
        ]);

        $cupon = Cupon::find($id);
        $cupon -> titulo    = $request -> titulo;
        $cupon -> tipo = $request -> tipo;
        $cupon -> descuento = $request -> descuento;
        $cupon -> fecha_inicio = $request -> fecha_inicio;
        $cupon -> fecha_termino = $request -> fecha_termino;
        $cupon -> limite = $request -> limite;
        $cupon -> save();
        return redirect()
            -> route('panel.cupon.list')
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
        $cupon = Cupon::find($id);
        $cupon -> delete();
        return response(['success' => true], 200);
    }

    public function changeStatus($id, Request $request){
        $cupon = Cupon::find($id);
        $cupon -> status = $request -> status == 'hidden' ? 0 : 1;
        $cupon -> save();
        return response(['success' => true], 200);
    }

    public function applyCupon(Request $request){
        $today = date('Y-m-d');
        if( Cupon::where('titulo', '=', $request -> cupon)->exists() ){
            $cupon = Cupon::where('titulo', $request -> cupon)->first();
            //Porcentaje
            if($cupon -> status == 1){
                if($cupon -> usos < $cupon -> limite){
                    if(self::validateRangeDate($today, $today, $cupon -> id)){
                       /* $cupon_discount = $cupon -> descuento;
                        if($cupon -> tipo == 2){
                            $discount = $cupon_discount * $request -> total / 100;
                            return response() -> json(Array('cupon_discount' => $cupon_discount, 'discount' => $discount, 'cupon_type' => 2, 'show_text' => $cupon_discount.' %', 'discount_text' => '-$'.number_format($discount), 'msg' => 'Descuento aplicado'));
                        }else{
                            $discount = $cupon_discount;
                            return response() -> json(Array('cupon_discount' => $cupon_discount, 'discount' => $discount, 'cupon_type' => 2, 'show_text' => '$'.$cupon_discount, 'discount_text' => '-$'.number_format($discount), 'msg' => 'Descuento aplicado'));
                        }*/
                        return response() -> json(Array('success' => true, 'msg' => 'Descuento Aplicado', 'cupon' => $cupon));
                    }else{
                        return response() -> json(Array('success' => false, 'msg' => 'Este cupon ha expirado',));
                    }

                }else{
                    return response() -> json(Array('success' => false, 'msg' => 'Este cupon ha alcanzado el limite de uso'));
                }

            }else{
                return response() -> json(Array('success' => false, 'msg' =>'Este cupon este desactivado'));
            }
        }else{
            return response() -> json(Array('success' => false, 'msg' => 'No se ha encontrado ese cupon'));
        }

    }

    static public function validateRangeDate($start, $end, $id_cupon){
        $sql = "SELECT id FROM cupon WHERE id = {$id_cupon} AND ((('{$start}' <= fecha_inicio) AND ('{$end}' > fecha_termino)) OR (('{$start}' >= fecha_inicio)AND('{$start}' < fecha_termino)))";
        $cita = DB::select($sql);
        return count($cita) ? true : false;
    }
}
