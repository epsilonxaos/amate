<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galeria';
    protected $fillable = ['rel_id', 'imagen', 'titulo', 'tipo', 'url'];
}
