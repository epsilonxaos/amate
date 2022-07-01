<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoCategoria extends Model
{
    protected $table = 'evento_categorias';
    protected $fillable = ['titulo', 'titulo_en', 'portada', 'status', 'orden'];
}
