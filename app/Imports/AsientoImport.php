<?php

namespace App\Imports;

use App\Asiento;
use Maatwebsite\Excel\Concerns\ToModel;

class AsientoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    var $evento_id;

    public function __construct($evento_id)
    {
        $this -> evento_id = $evento_id;
    }

    public function model(array $row)
    {
        return new Asiento([
            'rel_id' => $row[0],
            'folio' => $row[1],
            'num' => $row[2],
            'letra' => $row[3],
            'status' => $row[4],
            'evento_id' => $this -> evento_id
        ]);
    }
}
