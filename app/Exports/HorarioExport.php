<?php

namespace App\Exports;

use App\EventoHorario;
use App\Http\Controllers\FrontController;
use App\OrdenPerAsiento;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HorarioExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;


    public function __construct($evento_id)
    {
        $this -> evento_id = $evento_id;

    }

    /*public function query()
    {
        //return Orden::where('evento_id', $this -> evento_id)->get();
        //DB::enableQueryLog();
        $horario = EventoHorario::query()
            ->join('orden', 'orden.horario_id', '=', 'evento_horarios.id')
            ->where('orden.status', 2)
            ->where('evento_horarios.evento_id', $this -> evento_id)
            ->orderBy('evento_horarios.fecha', 'ASC')
            ->orderBy('evento_horarios.hora', 'ASC')
            ->select(['orden.folio', 'orden.nombre_completo', 'orden.correo', 'orden.telefono', 'orden.no_boletos', 'orden.pago_metodo', 'evento_horarios.fecha', 'evento_horarios.hora']);
        //dd(DB::getQueryLog());
        return $horario;
    }*/

    public function collection(): Collection{
        $horario = EventoHorario::join('orden', 'orden.horario_id', '=', 'evento_horarios.id')
            ->where('orden.status', 2)
            ->where('evento_horarios.evento_id', $this -> evento_id)
            ->orderBy('evento_horarios.fecha', 'ASC')
            ->orderBy('evento_horarios.hora', 'ASC')
            ->select(['orden.id','orden.folio', 'orden.nombre_completo', 'orden.correo', 'orden.telefono', 'orden.pago_metodo', 'evento_horarios.fecha', 'evento_horarios.hora'])
            ->get();
        $res = collect();
        foreach ($horario as $i => $a){
            $row['folio']       = $a->folio;
            $row['nombre']      = $a->nombre_completo;
            $row['correo']      = $a->correo;
            $row['telefono']    = $a->telefono;
            $asientos =  OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $a->id)->get()->toArray();
            $row['no_boletos']  = count($asientos);
            $row['asientos']    = FrontController::asientosToString($asientos);
            $row['pago_metodo'] = $a->pago_metodo;
            $row['fecha']       = $a->fecha;
            $row['hora']        = $a->hora;
            $res -> push($row);
        }
        return $res;
    }

    public function headings() :array {
        return ["Folio", "Nombre", "Correo", "Teléfono", "No. Boletos", 'Asientos Seleccionados', "Metodo Pago", "Fecha", 'Horario'];
    }

}
