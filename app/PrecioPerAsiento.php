<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioPerAsiento extends Model
{
    protected $table = 'precio_per_asiento';
    protected $fillable = ['precio_id', 'asiento_id'];
}
