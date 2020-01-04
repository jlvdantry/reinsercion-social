<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class expedientes extends Model
{
      protected $guarded = [];

    public static function getExpedientesporusuario($id)
    {
      $datos = DB::select('select expedientes.*'.
                   ' ,case when estatus=0 then \'Capturando\' when estatus=1 then \'Capturado\' else \'Desconocido\' end  desestatus '.
                   ' ,(select descripcion from situacionesjuridicas where id=expedientes.idsituacionjuridica) dessituacionjur '.
                   ' from expedientes where idbeneficiario=:id',['id' => $id]);
      Log::debug('app/expedientes.php id='.print_r($datos,true));
      return $datos;
    }

    public static function getExpedientescatalogos($id)
    {
      $datos = DB::select('select expedientes.*'.
                   ' ,case when estatus=0 then \'Capturando\' when estatus=1 then \'Capturado\' else \'Desconocido\' end  desestatus '.
                   ' ,(select descripcion from situacionesjuridicas where id=expedientes.idsituacionjuridica) dessituacionjur '.
                   ' from expedientes where id=:id',['id' => $id]);
      Log::debug('app/expedientes.php id='.print_r($datos,true));
      return $datos;
    }


}

