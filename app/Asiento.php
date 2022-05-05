<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    protected $table = 'asiento';
    protected $fillable = ['rel_id', 'evento_id', 'num', 'letra', 'folio', 'status'];
}
