<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupon';
    protected $fillable = ['titulo', 'tipo', 'descuento', 'fecha_inicio', 'fecha_termino', 'limite', 'usos', 'status'];
}
