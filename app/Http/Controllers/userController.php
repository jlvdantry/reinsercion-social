<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PerfilesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\OlvidoContrasena;
use App\Mail\UserAceptado;
use App\Mail\UserRechazado;
use Mail;
use DateTime;
use App\Alcaldias;
use App\Juzgados;
use App\Perfiles;

class userController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $datos = User::select('*',DB::Raw(
                'case when activo=0 then \'Pendiente\''.
                                                              ' when activo=0 then \'Inactivo\''.
                                                              ' when activo=1 then \'Activo\''.
                                                              ' when activo=2 then \'Rechazado\''.
                                                              ' when activo=3 then \'Eliminado\''.
                                                              ' else \'Desconocido\' end desactivo '.
                                                              ',case when tipopersona=\'F\' then \'Fisica\''.
                                                              ' when tipopersona=\'M\' then \'Moral\''.
                                                              ' else \'Desconocido\' end destipopersona '.
                                     ', (trim(coalesce(nombres,\'\')) || \' \' || trim(coalesce(ape_pat,\'\')) || \' \' || trim(coalesce(ape_mat,\'\'))) nombrecompleto '.
                                     ',(select descripcion from perfiles pe where pe.id in (select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) desperfil '
                               ))->where('id','=',$id)->get();
    return response()->json($datos);
  }

  public function detalleusuario($id)
  {
      $juzgados = Juzgados::all();
      $perfiles = Perfiles::all();
      $datos = User::select('*',DB::Raw(
                'case when activo=0 then \'Pendiente\''.
                ' when activo=1 then \'Aceptado\''.
                ' when activo=2 then \'Rechazado\''.
                ' when activo=3 then \'Eliminado\''.
                ' else \'Desconocido\' end desactivo '.
               ', (trim(coalesce(nombres,\'\')) || \' \' || trim(coalesce(ape_pat,\'\')) || \' \' || trim(coalesce(ape_mat,\'\'))) nombrecompleto '.
                ',(select descripcion from perfiles pe where pe.id in (select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) desperfil '.
                ',(select id from perfiles pe where pe.id in (select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) idperfil '
                ))->where('id','=',$id)->get();
           $data = array (
              'juzgados' => $juzgados,
              'user' => $datos[0],
              'perfiles' => $perfiles
           );
        return  view('detalle-usuario')->with('data',$data);
  }

  public function detalleterceracreditadotercero($id)
  {
      $datos = User::select('*',DB::Raw(
                'case when activo=0 then \'Pendiente\''.
                                                              ' when activo=1 then \'Aceptado\''.
                                                              ' when activo=2 then \'Rechazado\''.
                                                              ' when activo=3 then \'Eliminado\''.
                                                              ' else \'Desconocido\' end desactivo '.
                                     ', (trim(coalesce(nombres,\'\')) || \' \' || trim(coalesce(ape_pat,\'\')) || \' \' || trim(coalesce(ape_mat,\'\'))) nombrecompleto '.
                                     ',case '.
                                                              ' when id_nivel=1 then \'Capacitación de brigadas de PC\''.
                                                              ' when id_nivel=2 then \'Elaboración de programas internos para establecimientos o inmuebles de mediano riesgo\''.
                                                              ' when id_nivel=3 then \'Elaboración de programas internos de PC para establecimientos o inmuebles de alto riesgo\''.
                                                              ' when id_nivel=4 then \'Estudios de riesgo de vulnerabilidad\''.
                                                              ' else \'Desconocido\' end desnivel '.
                                     ',(select descripcion from perfiles pe where pe.id in (select idperfil from perfiles_users where idusuario=users.id) limit 1 order by id desc) desperfil '
                               ))->where('id','=',$id)->get();
    return  view('secretaria.detalle-terceros-acreditados-tercero')->with('user',$datos[0]);
  }



  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function estadistica(Request $request)
  {
      $filtro=array();

      if ($request->has('rfc')) {
        if (strlen($request->rfc)>0) {
           array_push($filtro,['rfc', 'like',"%$request->rfc%"]);
        }
      }
      if ($request->has('email')) {
        if (strlen($request->email)>0) {
           array_push($filtro,['email','like',"%$request->email%"]);
        }
      }

      if ($request->has('nombres')) {
        if (strlen($request->nombres)>0) {
           array_push($filtro,['nombres','like',"%$request->nombres%"]);
        }
      }
      $datos = User::estadistica($filtro);
      return response()->json($datos);

   }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index(Request $request)
  {
      $filtro=array();

      if ($request->has('rfc')) {
        if (strlen($request->rfc)>0) {
           array_push($filtro,['rfc', 'like',"%$request->rfc%"]);
        }
      }

      if ($request->has('idperfil')) {
        if (strlen($request->idperfil)>0) {
           array_push($filtro,['idperfil', '=',$request->idperfil]);
        }
      }

      if ($request->has('activo')) {
        if (strlen($request->activo)>0) {
           array_push($filtro,['activo','=',$request->activo]);
        }
      }

      if ($request->has('email')) {
        if (strlen($request->email)>0) {
           array_push($filtro,['email','like',"%$request->email%"]);
        }
      }

      if ($request->has('nombres')) {
        if (strlen($request->nombres)>0) {
           array_push($filtro,['nombres','like',"%$request->nombres%"]);
        }
      }
      if ($request->has('ape_pat')) {
        if (strlen($request->ape_pat)>0) {
           array_push($filtro,['ape_pat','like',"%$request->ape_pat%"]);
        }
      }
      if ($request->has('ape_mat')) {
        if (strlen($request->ape_mat)>0) {
           array_push($filtro,['ape_mat','like',"%$request->ape_mat%"]);
        }
      }

      //if (count($filtro)==0) {
      //   return response()->json('Debe de especificar un dato para consultar',499);
      //}
      //Log::debug('userControler index='.print_r($filtro,true));
      //$datos = Imeis::select('*',DB::Raw('codigo_sms_estatus_reg AS candado'))->where($filtro)->get();
      $datos = User::select('*',DB::Raw(
                'case when activo=0 then \'Inactivo\''.
                                               ' when activo=1 then \'Activo\''.
                                               ' when activo=2 then \'Rechazado\''.
                                               ' when activo=3 then \'Eliminado\''.
                                               ' else \'Desconocido\' end desactivo '.
                                  ', (trim(coalesce(nombres,\'\')) || \' \' || trim(coalesce(ape_pat,\'\')) || \' \' || trim(coalesce(ape_mat,\'\'))) nombrecompleto '.
                                     ',coalesce((select descripcion from perfiles pe where pe.id in '.
                                          '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1),\'\') desperfil '.
                                     ',(select id from perfiles pe where pe.id in '.
                                          '(select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) idperfil '
                               ))->where($filtro)->get();
      return response()->json($datos);
  }

  public function update(Request $request,$id)
  {
            $data=array();
            //Log::debug('userControler update queactualizo='.print_r($request->all(),true));
            if (strpos($id,'@')!==false) {
               $dato = User::where('email','=',$id)->get();
               if ($dato->count()>0) {
                  $upddata['cambiocontra']=$dato[0]->generateToken();
                  $datox = User::where('email','=',$id)->update($upddata);
                  $dato[0]['cambiocontra']=$upddata['cambiocontra'];
                  Mail::to($dato[0]->email)->send(new OlvidoContrasena($dato[0]));
                  return response()->json('Se envio email',200);
               } else {
                  return response()->json('El email no esta registrado',480);
               }
            }
            if (array_key_exists('activo',$request->all())) {
                $data['activo']=$request->activo;
                $data['idjuzgado']=$request->idjuzgado;
                $cp = new User;
                $cp->cambiaperfil($id,$request->idperfil); 
                $dato = User::getconCatalogosbyID($id);
                $datox = User::where('id','=',$id)->update($data);
                if ($datox==0) {
                  return response()->json('No actualizo el usuario',412);
                } else {
                  if ($request->activo==1) {
                     Mail::to($dato->email)->send(new UserAceptado($dato));
                  }
                  if ($request->activo==2) {
                      Mail::to($dato->email)->send(new UserRechazado($dato, $request->rechazo)); 
                  }
                  return response()->json('El usuario se actualizo',200);
                }
            }

            if (array_key_exists('desactivo',$request)) {
               switch ($request->queactualizo['desactivo']) {
                   case 'Pendiente de activar':
                       $data['activo']=0;
                       break;
                   case 'Activo':
                       $data['activo']=1;
                       break;
                   case 'Bloqueado':
                       $data['activo']=2;
                       break;
                   default:
                       $data['activo']=3;
               }
               $dato = User::where('id','=',$id)->update($data);
               if ($dato==0) {
                  return response()->json('No actualizo el usuario',412);
               } else {
                  return response()->json('El usuario se actualizo',200);
               }
            }
            if (array_key_exists('perfiles',$request)) {
               switch ($request->queactualizo['perfiles']) {
                   case 'Sin perfil':
                       $data['idperfil']=0;
                       break;
                   case 'Administrador':
                       $data['idperfil']=1;
                       break;
                   case 'Operador':
                       $data['idperfil']=2;
                       break;
                   default:
                       $data['idperfil']=0;
               }
               $dato = PerfilesUsers::where('idusuario','=',$id)->delete();
               $dato = new PerfilesUsers([
                         'idperfil' => $data['idperfil'],
                         'idusuario' => $id
                         ]);
               $dato->save();
               return response()->json($dato,200);
            }
            if ($request->has('nombres')) {
                $data['nombres']=$request->nombres;
            }
            if ($request->has('ape_pat')) {
                $data['ape_pat']=$request->ape_pat;
            }
            if ($request->has('ape_mat')) {
                $data['ape_mat']=$request->ape_pat;
            }
            if ($request->has('rfc')) {
                $data['rfc']=$request->rfc;
            }
            if ($request->has('sgirpc')) {
                $data['sgirpc']=$request->sgirpc;
            }
            if ($request->has('stps')) {
                $data['stps']=$request->stps;
            }
            if ($request->has('vigencia')) {
                $data['vigencia']=$request->vigencia;
            }
            if ($request->has('cb')) {
                $data['cb']=$request->cb;
            }
            if ($request->has('epmr')) {
                $data['epmr']=$request->epmr;
            }
            if ($request->has('erv')) {
                $data['erv']=$request->erv;
            }
            if ($request->has('rpar')) {
                $data['rpar']=$request->rpar;
            }
            if ($request->has('calle')) {
                $data['calle']=$request->calle;
            }
            if ($request->has('exterior')) {
                $data['exterior']=$request->exterior;
            }
            if ($request->has('interior')) {
                $data['interior']=$request->interior;
            }
            if ($request->has('colonia')) {
                $data['colonia']=$request->colonia;
            }
            if ($request->has('id_alcaldia')) {
                $data['id_alcaldia']=$request->id_alcaldia;
            }
            if ($request->has('cp')) {
                $data['cp']=$request->cp;
            }
            if ($request->has('num_telefono')) {
                $data['num_telefono']=$request->cp;
            }
            if (count($data)>0) {
                $datox = User::where('id','=',$id)->update($data);
                if ($datox==0) {
                  return response()->json('No actualizo el usuario',412);
                } else {
                  return response()->json('El usuario se actualizo',200);
                }
            }

            return response()->json('No se encontraron datos para actualizar',413);
    }

    public function restacontra(Request $request)
    {
        log::debug('Entro a userController.php restacontra');
        $validatedData = $request->validate([
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ],[
            'password.required' => 'El nuevo password es requerido',
            'password.min' => 'El nuevo password debe tener al menos 6 caracteres',
            'password_confirmation.required' => 'La confirmacion del nuevo password no checa'
        ]);
        log::debug('Entro a userController.php restacontra paso validaciones');

        $datos = User::where('cambiocontra','=',$request->cambiocontra)->get();
          log::debug('Entro a userController.php cambiacontra checo el password actual');
        if ($datos->count()>0) {
           $datetime1 = new DateTime();
           $datetime2 = new DateTime($datos[0]->updated_at);
           $interval = $datetime1->diff($datetime2);
           $elapsed = $interval->format('%i minutos');

           Log::debug('imeisControler tiempo transcurrido='.$elapsed);
           if ($elapsed>5) {
              return response()->json('El limite de tiempo para cambiar su password es de 5 minutos y usted lo hizo, intente de nuevo',481);
          }

          $datos[0]->password = \Hash::make($request->password);
          $datos[0]->cambiocontra = '';
          $datos[0]->save();
          return response()->json('Se actualizo la contraseña',200);
        }
        else
        {
          log::debug('Entro a userController.php cambiacontra no checo el password actual');
          return response()->json('No se encuentra solicitud de restauración de contraseña por olvido',427);
        }
    }

    public function cambiacontra(Request $request)
    {
        log::debug('Entro a userController.php cambiacontra');
        $validatedData = $request->validate([
            'oldpass' => 'required|min:6',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ],[
            'oldpass.required' => 'Contraseña actual es requerida',
            'oldpass.min' => 'La contraseña actual debe tener al menos 6 caracteres',
            'password.required' => 'El nuevo password es requerido',
            'password.min' => 'El nuevo password debe tener al menos 6 caracteres',
            'password_confirmation.required' => 'La confirmacion del nuevo password no checa'
        ]);
        log::debug('Entro a userController.php cambiacontra paso validaciones');

        $current_password = \Auth::User()->password;
        log::debug('Entro a userController.php cambiacontra obitene el password actual');
        if(\Hash::check($request->input('oldpass'), $current_password))
        {
          log::debug('Entro a userController.php cambiacontra checo el password actual');
          $user_id = \Auth::User()->id;
          $obj_user = User::find($user_id);
          $obj_user->password = \Hash::make($request->input('password'));
          $obj_user->save();
          return response()->json('Se actualizo la constraseña',200);
        }
        else
        {
          log::debug('Entro a userController.php cambiacontra no checo el password actual');
          return response()->json('La contraseña actual no checa',420);
        }
    }

//Controlador formulario editar perfil tercer acreditado
    public function editarPerfil($id){
      $juzgados=Juzgados::all();
      $users = User::select('*',DB::Raw(
                                            '(select descripcion from perfiles pe '.
                                            'where pe.id in (select idperfil from perfiles_users where idusuario=users.id) order by id desc limit 1) desperfil '
                               ))->where('id','=',$id)->get();
      return view('editarperfil', compact ('users','juzgados'));
    }

}
