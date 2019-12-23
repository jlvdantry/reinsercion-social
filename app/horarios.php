<?php

namespace App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class horarios extends Model
{
      protected $guarded = [];

    public static function getconCatalogos($filtro=[])
    {
        $wlfiltro="";
        foreach ($filtro as $k => $v) {
               if ($wlfiltro=="") {
                   $wlfiltro.=$filtro[$k][0]." ".$filtro[$k][1]." '".$filtro[$k][2]."'";
               } else {
                   $wlfiltro.=" and ".$filtro[$k][0]." ".$filtro[$k][1]." '".$filtro[$k][2]."'";
               }
        }
        $wlfiltro=($wlfiltro!="" ? " where ".$wlfiltro : "");

      $datos = DB::select('select horarios.*'.
                                  ', to_char(horade,\'HH:MI\') || \' - \' || to_char(horahasta,\'HH:MI\') horario '.
                                  ',(select descripcion from grupo_actividades ga where ga.id=horarios.idgrupo) desgrupo '.
                                  ', acti.descripcion desactividad '.
                                  ',case '.
                                               ' when estatus=0 then \'Inactivo\''.
                                               ' when estatus=1 then \'Activo\''.
                                               ' else \'Desconocido\' end desestatus '.
                   ' from horarios left join actividades acti on horarios.idactividad=acti.id'.
                   $wlfiltro
                   );
      Log::debug('app/actividades.php getconCatalogos id='.print_r($datos,true));
      return $datos;
    }

}
