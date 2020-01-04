<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class demandas extends Model
{
      protected $guarded = [];
    public static function getdemandasbyexpediente($id)
    {
      $datos = DB::select('select demandas.*'.
                   ' ,(select descripcion from resultados  where id=demandas.idresultado) desresultado '.
                   ' ,(select descripcion from tipodemandas where id=demandas.iddemanda) destipodemanda '.
                   ' from demandas where idexpediente=:id',['id' => $id]);
      Log::debug('app/expedientes.php id='.print_r($datos,true));
      return $datos;
    }
    public static function getdemandabyid($id)
    {
      $datos = DB::select('select demandas.*'.
                   ' ,(select descripcion from resultados  where id=demandas.idresultado) desresultado '.
                   ' ,(select descripcion from tipodemandas where id=demandas.iddemanda) destipodemanda '.
                   ' from demandas where id=:id',['id' => $id]);
      Log::debug('app/demandas.php id='.print_r($datos,true));
      return $datos[0];
    }

}
