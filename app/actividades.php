<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class actividades extends Model
{
    protected $fillable = [
        'descripcion',
        'idgrupo'
    ];

    public static function getconCatalogosbyID($id)
    {
      $datos = DB::select('select actividades.*'.
                                  ',(select descripcion from grupo_actividades ga where ga.id=actividades.idgrupo) desgrupo '.
                   ' from actividades where id=:id',['id' => $id]);
      Log::debug('app/actividades.php getconCatalogosbyID id='.print_r($datos[0],true));
      return $datos[0];
    }

    public static function getActividadesporgrupo($id)
    {
      $datos = DB::select('select actividades.*'.
                                  ',(select descripcion from grupo_actividades ga where ga.id=actividades.idgrupo) desgrupo '.
                   ' from actividades where idgrupo=:id',['id' => $id]);
      Log::debug('app/actividades.php getconCatalogosbyID id='.print_r($datos,true));
      return $datos;
    }



}
