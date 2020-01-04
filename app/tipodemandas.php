<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class tipodemandas extends Model
{
    public static function gettipodemandasfaltantes($id)
    {
      $datos = DB::select('select tipodemandas.*'.
                   ' from tipodemandas where '.
                   ' id not in (select iddemanda from demandas where idexpediente=:id) order by descripcion' ,['id' => $id]);
      Log::debug('app/tipodemandas.php id='.print_r($datos,true));
      return $datos;
    }

}
