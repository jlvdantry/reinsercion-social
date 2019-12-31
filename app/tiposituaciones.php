<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class tiposituaciones extends Model
{
    public static function getTiposituacionesporsituacion($id)
    {
      $datos = DB::select('select tiposituaciones.*'.
                                  ',(select descripcion from situacionesjuridicas ga where ga.id=tiposituaciones.idsituacionjuridica) dessituacionjuridica '.
                   ' from tiposituaciones where idsituacionjuridica=:id',['id' => $id]);
      Log::debug('app/tiposituaciones.php getTipossituacionesporsituacion id='.print_r($datos,true));
      return $datos;
    }

}
