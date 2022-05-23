<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    protected $fillable = ['titulo', 'portada', 'descripcion', 'descripcion_2', 'lugar', 'latitud', 'longitud', 'tipo', 'categoria_id'];

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
