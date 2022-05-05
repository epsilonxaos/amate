<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documental extends Model
{
    protected $table = 'documental';
    protected $fillable = ['titulo', 'portada', 'descripcion', 'descripcion_2', 'status'];
}
