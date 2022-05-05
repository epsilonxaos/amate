<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenPerAsiento extends Model
{
    protected $table = 'orden_per_asiento';
    protected $fillable = ['orden_id', 'asiento_id', 'precio'];
    public $timestamps = false;
}
