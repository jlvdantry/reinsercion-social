<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Perfiles_users;
use App\Perfiles_menus;
use App\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres', 'email', 'password','ape_pat','ape_mat','calle','rfc','sgirpc','id_nivel','vigencia','stps','exterior','interior'
         ,'colonia','idjuzgado','cp','num_telefono','tipopersona','activo','puesto','idperfiltallerista'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();
        return $this->api_token;
    }
    public function cambiaperfil($id,$perfil)
    {
            $deletedRows = Perfiles_users::where("idusuario",$id)->delete();
            $pe = new Perfiles_users ( [ "idusuario" => $id, "idperfil" => $perfil ] );
            $pe->save();
            return true;
    }

    public function getperfiles()
    {
         Log::debug('app/User.php id el usuarios='.$this->id);
        $perfiles = Perfiles_users::select('*',DB::Raw('(select descripcion from perfiles where perfiles.id=perfiles_users.idperfil) as desperfil'))->where('idusuario', '=', $this->id)->get();
         Log::debug('app/User.php cuantos perfiles='.count($perfiles));
        if (count($perfiles)==0) {
          return [ 'descripcion' => 'Sin perfil', 'desperfil' => 'Sin perfil' ] ;
        } else { 
          return $perfiles[0];
        }
    }

    public static function getTalleristas()
    {
      Log::debug('app/User.php getTalleristas ');
      $datos = DB::select('select users.*'.
                ',case when activo=0 then \'Pendiente\''.
                                               ' when activo=1 then \'Aceptado\''.
                                               ' when activo=2 then \'Rechazado\''.
                                               ' when activo=3 then \'Eliminado\''.
                                               ' else \'Desconocido\' end desactivo '.
                                  ', (trim(coalesce(nombres,\'\')) || \' \' || trim(coalesce(ape_pat,\'\')) || \' \' || trim(coalesce(ape_mat,\'\'))) nombrecompleto '.
                                  ',(select descripcion from perfiles pe where pe.id in '.
                                          '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) desperfil '.
                                  ',(select id from perfiles pe where pe.id in '.
                                         '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) idperfil '.
                   ' from users '.
                   ' left join perfiles_users pu on  idusuario=users.id '.
                   ' where pu.idperfil=3 '
                   );
      Log::debug('app/User.php getconCatalogosbyID id='.print_r($datos,true));
      return $datos;

    }

    public static function getSecretariosJuzgado($id)
    {
      Log::debug('app/User.php getSecretariosJuzgado id='.$id);
      $datos = DB::select('select users.*'.
                ',case when activo=0 then \'Pendiente\''.
                                               ' when activo=0 then \'Inactivo\''.
                                               ' when activo=1 then \'Activo\''.
                                               ' when activo=2 then \'Rechazado\''.
                                               ' when activo=3 then \'Eliminado\''.
                                               ' else \'Desconocido\' end desactivo '.
                                  ', (trim(coalesce(nombres,\'\')) || \' \' || trim(coalesce(ape_pat,\'\')) || \' \' || trim(coalesce(ape_mat,\'\'))) nombrecompleto '.
                                  ',(select descripcion from perfiles pe where pe.id in '.
                                          '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) desperfil '.
                                  ',(select id from perfiles pe where pe.id in '.
                                         '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) idperfil '.
                                  ',(select juzgado from juzgados where id = users.idjuzgado) desjuzgado'.
                                  ',(select direccion from juzgados where id = users.idjuzgado) dirjuzgado'.
                   ' from users '.
                   ' left join perfiles_users pu on  idusuario=users.id '.
                   ' where pu.idperfil=3 and idjuzgado=:id'
                   ,['id' => $id]);
      //Log::debug('app/User.php getconCatalogosbyID id='.print_r($datos[0],true));
      return $datos;

    }


    public function getmenus($id)
    {
         Log::debug('app/User.php getmenus id el usuarios='.$this->id);
        $menus = Perfiles_menus::select('*',DB::Raw('(select descripcion from menus where menus.id=perfiles_menus.idmenu) as desmenu'.
                                                       ',(select componente from menus where menus.id=perfiles_menus.idmenu) as componente'
                                                       ))->where('idperfil', '=', $id)->get();
         Log::debug('app/User.php getmenus cuantos menus='.count($menus));
        if (count($menus)==0) {
          return [ 'descripcion' => 'Sin Menus' ] ;
        } else {
          return $menus;
        }
    }

    public function getmenuspadres($id)
    {
         Log::debug('app/User.php getmenus id el usuarios='.$this->id);
        $menus = Perfiles_menus::select('*',DB::Raw('(select descripcion from menus where menus.id=perfiles_menus.idmenu) as desmenu'.
                                                       ',(select componente from menus where menus.id=perfiles_menus.idmenu) as componente'
                                                       ))->where([['idperfil', '=', $id],['idmenupadre','=',0]])->get();
         Log::debug('app/User.php getmenus cuantos menus='.count($menus));
        if (count($menus)==0) {
          return [ 'descripcion' => 'Sin Menus' ] ;
        } else {
          return $menus;
        }
    }

    public function getmenushijos($id,$idpadre)
    {
         Log::debug('app/User.php getmenus id el usuarios='.$this->id." padre=".$idpadre);
        $menus = Perfiles_menus::select('*',DB::Raw('(select descripcion from menus where menus.id=perfiles_menus.idmenu) as desmenu'.
                                                       ',(select componente from menus where menus.id=perfiles_menus.idmenu) as componente'
                                                       ))->where([['idperfil', '=', $id],['idmenupadre','=',$idpadre]])->get();
         Log::debug('app/User.php getmenus cuantos menus='.print_r($menus,true));
        if (count($menus)==0) {
          return [ 'descripcion' => 'Sin Menus' ] ;
        } else {
          return $menus;
        }
    }


    public static function estadistica($filtros)
    {
      $datos = DB::select('select (trim(coalesce(users.nombres,\'\')) || \' \' || trim(coalesce(users.ape_pat,\'\')) || \' \' || trim(coalesce(users.ape_mat,\'\'))) nombrecompleto '.
                          ', email '.
                          ', (select count(*) from establecimientos esta1 where users.email=esta1.email_acreditado) estable'.
                          ', (select count(*) from inmuebles inmu where users.email=inmu.email_acreditado ) inmu'.
                          ', (select count(*) from inmuebles inmu where users.email=inmu.email_acreditado and coalesce(estatus,0)=0) capturando'.
                          ', (select count(*) from inmuebles inmu where users.email=inmu.email_acreditado and coalesce(estatus,0)=1) capturados'.
                          ' from users '.
                          ' where (select count(*) from perfiles_users pu where pu.idusuario=users.id and idperfil=2)>0 '.
                          ' union all'.
                          ' select  '.
                          ' \'Total acreditados\' a '.
                          ',  cast(count(*) as varchar) email '.
                          ', sum(estable) estable, sum(inmu) inmu, sum(capturando) capturando, sum(capturados) capturados'.
                          ' from ('.
                          '    select (trim(coalesce(users.nombres,\'\')) || \' \' || trim(coalesce(users.ape_pat,\'\')) || \' \' || trim(coalesce(users.ape_mat,\'\'))) nombrecompleto '.
                          ', email '.
                          ', (select count(*) from establecimientos esta1 where users.email=esta1.email_acreditado) estable'.
                          ', (select count(*) from inmuebles inmu where users.email=inmu.email_acreditado ) inmu'.
                          ', (select count(*) from inmuebles inmu where users.email=inmu.email_acreditado and coalesce(estatus,0)=0) capturando'.
                          ', (select count(*) from inmuebles inmu where users.email=inmu.email_acreditado and coalesce(estatus,0)=1) capturados'.
                          ' from users '.
                          ' where (select count(*) from perfiles_users pu where pu.idusuario=users.id and idperfil=2)>0 '.
                          ' ) a '
                          );
      return $datos;
    }

    public static function getconCatalogosbyID($id)
    {
      $datos = DB::select('select users.*'.
                ',case when activo=0 then \'Pendiente\''.
                                               ' when activo=0 then \'Inactivo\''.
                                               ' when activo=1 then \'Activo\''.
                                               ' when activo=2 then \'Rechazado\''.
                                               ' when activo=3 then \'Eliminado\''.
                                               ' else \'Desconocido\' end desactivo '.
                                  ', (trim(coalesce(nombres,\'\')) || \' \' || trim(coalesce(ape_pat,\'\')) || \' \' || trim(coalesce(ape_mat,\'\'))) nombrecompleto '.
                                  ',(select descripcion from perfiles pe where pe.id in '.
                                          '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) desperfil '.
                                  ',(select id from perfiles pe where pe.id in '.
                                         '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) idperfil '.
                                  //',(select juzgado from juzgados where id = users.idjuzgado) desjuzgado'.
                                  //',(select direccion from juzgados where id = users.idjuzgado) dirjuzgado'.
                   ' from users where id=:id',['id' => $id]);
      Log::debug('app/User.php getconCatalogosbyID id='.print_r($datos[0],true));
      return $datos[0];
    }

    public function getFullName() {
        return $this->nombres.' '.$this->ape_pat;
    }

    public function getAlcaldia() {
        $alcaldia = DB::select('select descripcion from alcaldias alc left join juzgados juz on alc.id_cat_alcaldia=juz.idalcaldia where juz.id=:id',['id' => $this->idjuzgado]);
        return $alcaldia ? $alcaldia[0]->descripcion : 'Sin alcaldia';
    }

    public function getJuzgado() {
        $juzgado = Juzgados::where('id', '=', $this->idjuzgado)->first();
        return $juzgado ? $juzgado->juzgado : '';
    }
}
