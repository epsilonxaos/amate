<?php

namespace App;

use App\Evento;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Helpers {
    /**
     * Add files to storage.
     *
     * @param $request -> file  $file
     * @param $directorio  $directorio
     * @return $ruta
     */
    public static function addFileStorage($file, $directorio) {
        // $ruta = Storage::disk('public_uploads')->put($directorio, $file);

        // return 'uploads/'.$ruta;
        $ruta = $file -> store($directorio);
        $exploded = explode('/', $ruta);
        $exploded[0] = 'storage';
        $ruta = implode('/', $exploded);

        return $ruta;
    }

    /**
     * Delete files from storage
     *
     * @param string Name table database $table
     * @param string name column to database table  $name
     * @param string Id of row  $id
     */
    public static function deleteFileStorage(String $table, String $name, Int $id){
        $file  = DB::table($table) -> select($name) -> where('id', $id) -> first();

        if(File::exists($file -> $name)) {
            File::delete($file -> $name);
        }
    }

    /**
     * Change status to show - hidden
     *
     * @param string Name table database $table
     * @param string Id of row  $id
     * @param string New status  $status
     */
    public static function changeStatus($table, $id, $status)
    {
        DB::table($table) -> where('id', $id) -> update(['status' => $status]);
    }

    /**
     * Return fecha en español - 01 de Marzo del 2021
     * @param string Required date  $fecha
     * @return string New Date
     */
    public static function dateSpanishComplete($fecha){
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y') ;
    }
    public static function dateComplete($fecha){
        $meses = array("January","February","March","April","May","June","July","August","September","Octuber","November","December");

        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        return $mes . ' '. $fecha->format('d') . ', ' . $fecha->format('Y') ;
    }

    /**
     * Return fecha en español corto - 01/Mar/2021
     * @param string Required date  $fecha
     * @return string New Date
     */
    public static function dateSpanishShort($fecha){
        $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . '/' . $mes . '/' . $fecha->format('Y') ;
    }

    public static function getMes($key) {
        $mes = array(
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'Octuber' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        );

        return $mes[$key];
    }

    public static function getDia($key) {
        $dias = array(
            'Mon' => 'Lun',
            'Tue' => 'Mar',
            'Wed' => 'Mie',
            'Thu' => 'Jue',
            'Fri' => 'Vie',
            'Sat' => 'Sab',
            'Sun' => 'Dom',
        );

        return $dias[$key];
    }

    public static function inTime($time){
        $to = Carbon::now();
        $from = Carbon::createFromFormat('Y-m-d H:s:i', $time);


        // return $from;

        return $to > $from ? 'off-time' : '';
    }

    public static function dateTo12Hrs($hora)
    {
        return date("g:i a", strtotime($hora));
    }

    public static function colorCategoriaEvento($categoria)
    {
        switch ($categoria) {
            case 1:
                return 'rojo';
                break;
            case 2:
                return 'azul';
                break;
            case 3:
                return 'main';
                break;
            case 4:
                return 'verde';
                break;
            case 5:
                return 'main';
                break;
            
            default:
                return 'main';
                break;
        }
    }
}
