<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoHorario extends Model
{
    protected $table = 'evento_horarios';
    protected $fillable = ['evento_id', 'fecha', 'hora', 'status', 'cupo'];
}
