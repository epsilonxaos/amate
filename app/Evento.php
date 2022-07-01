<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $fillable = ['titulo', 'titulo_en', 'portada', 'descripcion', 'descripcion_en', 'descripcion_2', 'descripcion_2_en', 'lugar', 'latitud', 'longitud', 'tipo', 'categoria_id'];

    function horarios(){
        return $this -> hasMany('App\EventoHorario');
    }
    function precios(){
        return $this -> hasMany('App\EventoPrecio');
    }
    function asientos(){
        return $this -> hasMany('App\Asiento');
    }
}
