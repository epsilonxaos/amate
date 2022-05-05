<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoPrecio extends Model
{
    protected $table = 'evento_precios';
    protected $fillable = ['evento_id', 'precio', 'concepto', 'tipo', 'comision'];
}
