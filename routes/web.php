<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Log;
use App\User;
use App\Perfiles;
use App\alcaldias;
use App\acercamientos;
use App\entidades;
use App\situacionesjuridicas;
use App\centros;
use App\tiposituaciones;
use App\tipodemandas;
use App\resultados;
use App\comoseentero;
use App\estudios;
use App\etnicas;
use App\ocupaciones;
use App\eciviles;
use App\grupo_actividades;
use App\Http\Controllers\userController;
log::debug('routes/web.php inioio URL='.URL::current().' Request::path()='.\Request::path());
Route::get('/', function () {
    log::debug('routes/web.php va a ejecutar welcome / URL='.URL::current().' Request::path()='.\Request::path());
    \Request::session()->invalidate();
    Auth::logout();
    return view('welcome');
})->name('login');

Route::get('mail_OlvidoContrasena', function () {
    $user = App\User::getconCatalogosbyID(2);
    log::debug('routes/web.php l_OlvidoContrasena user='.print_r($user,true));
    return new App\Mail\OlvidoContrasena($user);
});

Route::get('/restaura/{si}', function () {
      log::debug('Por donde se fue 00');
      return view('restaura');
});

Route::get('pdf/{id}', 'PdfController@hechos');


Route::get('/correo_registro', function () {
  $user = App\User::getconCatalogosbyID(16);
  return new App\Mail\UserRegistrado($user);
  });

Route::get('/correo_aceptado', function () {
  $user = App\User::getconCatalogosbyID(20);
  return new App\Mail\UserAceptado($user);
  });

  Route::get('/inmueble_registro_exitoso', function () {
      return view('correos.inmueble_registrado');
  });

Route::get('/perfil_tercer_acreditado', function () {
    return view('perfil_tercer_acreditado');
});

Route::get('/404error', function () {
    return view('error404');
});


//Secretaria
Route::get('/cambio-contra', function () {
         return view('cambio-contra');
    });


Route::group(['middleware' => ['auth:web']], function() {

    Route::get('/notienecuenta', function () {
        $perfiles = Perfiles::all();
        return view('notienecuenta')->with('perfiles', $perfiles);
    });

    Route::get('/altahorario', function () {
        //$perfiles = Perfiles::all();
        $grupos = App\grupo_actividades::all();
        $alcaldias = App\alcaldias::all();
        $talleristas = App\User::getTalleristas();
           $data = array (
              'alcaldias' => $alcaldias,
              'grupos' => $grupos,
              'talleristas' => $talleristas
           );

        return view('altahorario')->with('data',$data);
    });

    log::debug('routes/web.php Entro a middleware web '.URL::current());
    Route::get('/usuarios-registrados', function () {
        log::debug('routes/web.php va a ejecutar '.URL::current());
        $perfiles = Perfiles::all();
        return view('usuarios-registrados')->with('perfiles', $perfiles);
    });
    Route::get('/registro-exitoso', function () {
         return view('registro-exitoso');
    });
    Route::get('/beneficiarios', function () {
         return view('beneficiarios');
    });

    Route::get('/altabeneficiario', function () {
        $acercamientos = acercamientos::all();
        $comoseenteros = comoseentero::all();
        $estudios = estudios::all();
        $etnicas = etnicas::all();
        $ocupaciones = ocupaciones::all();
        $eciviles = eciviles::all();
        $entidades = entidades::all();
        $alcaldias = alcaldias::all();
        $data = array (
            'acercamientos' => $acercamientos,
            'comoseenteros' => $comoseenteros,
            'estudios' => $estudios,
            'etnicas' => $etnicas,
            'ocupaciones' => $ocupaciones,
            'eciviles' => $eciviles,
            'entidades' => $entidades,
            'alcaldias' => $alcaldias,
        );
         return view('altabeneficiario')->with('data', $data);
    });

    Route::get('beneficiarios/{id}', function () {
        $acercamientos = acercamientos::all();
        $comoseenteros = comoseentero::all();
        $estudios = estudios::all();
        $etnicas = etnicas::all();
        $ocupaciones = ocupaciones::all();
        $eciviles = eciviles::all();
        $entidades = entidades::all();
        $alcaldias = alcaldias::all();
        $data = array (
            'acercamientos' => $acercamientos,
            'comoseenteros' => $comoseenteros,
            'estudios' => $estudios,
            'etnicas' => $etnicas,
            'ocupaciones' => $ocupaciones,
            'eciviles' => $eciviles,
            'entidades' => $entidades,
            'alcaldias' => $alcaldias,
        );
         return view('altabeneficiario')->with('data', $data);
    });


    Route::get('/gruposactividades', function () {
         return view('grupo-actividades');
    });
    Route::get('/actividades', function () {
         $grupos = App\grupo_actividades::all();
         return view('actividades')->with('grupos',$grupos);
    });
    Route::get('/horarios', function () {
         //$grupos = App\grupo_actividades::all();
         return view('horarios-registados');
    });

    Route::get('/registro-inmueble-exitoso/{id}', function ($id) {
         $inmueble= Inmuebles::where('id','=',$id)->get();
         return view('registro-inmueble-exitoso')->with('inmueble', $inmueble[0]);
    });

    Route::get('/detalle-tercer-acreditado-tercero/{id}', 'userController@detalleterceracreditadotercero');
    Route::get('/detalle-usuario/{id}', 'userController@detalleusuario');

    Route::get('/informacion-actualizada', function () {
         return view('perfil-actualizado');
    });


    Route::get('/establecimientos-registrados-seleccionados-secretaria', function () {
        return view('secretaria.establecimientos-registrados-secretaria-seleccionados');
    });

    Route::get('/establecimientos-registrados-todos-secretaria', 'establecimientosController@establecimientosIndex');
    Route::get('/inmuebles-registrados-todos-secretaria',  function () {
              $alcaldias = Alcaldias::all();
              return view('secretaria.inmuebles-registrados-secretaria-todos')->with('alcaldias', $alcaldias);
             });

    Route::get('/estadistica-acreditados',  function () {
              return view('estadistica-acreditados');
             });

    Route::get('expedientes/0/{id}',  function ($id) {
           log::debug('routes/web.php va a ejecutar expedientes / URL='.$id.' Request::path()='.\Request::path());
           $alcaldias = Alcaldias::all();
           $entidades = Entidades::all();
           $situacionesjuridicas = Situacionesjuridicas::all();
           $tiposituaciones = tiposituaciones::all();
           $tipodemandas = tipodemandas::all()->orderBy('descripcion');
           $centros = centros::all();
           $resultados = resultados::all();
           $beneficiario = User::getconCatalogosbyID($id);
           $escolaridades = DB::table('escolaridades')->orderBy('descripcion')->get();
           $data = array (
              'alcaldias' => $alcaldias,
              'entidades' => $entidades,
              'situacionesjuridicas' => $situacionesjuridicas,
              'tiposituaciones' => $tiposituaciones,
              'centros' => $centros,
              'tipodemandas' => $tipodemandas,
              'resultados' => $resultados,
              'beneficiario' => $beneficiario,
              'escolaridades' => $escolaridades
           );
           return view('expedientes')->with('data', $data);
    });

    Route::get('expedientes/{idex}/{idben}',  function ($idex,$idben) {
           log::debug('routes/web.php va a ejecutar expedientes / URL='.$idben.' Request::path()='.\Request::path());
           $alcaldias = Alcaldias::all();
           $entidades = Entidades::all();
           $situacionesjuridicas = Situacionesjuridicas::all();
           $tiposituaciones = tiposituaciones::all();
           $tipodemandas = DB::table('tipodemandas')->orderBy('descripcion')->get();
           $centros = centros::all();
           $resultados = DB::table('resultados')->orderBy('descripcion')->get();
           $escolaridades = DB::table('escolaridades')->orderBy('descripcion')->get();
           $beneficiario = User::getconCatalogosbyID($idben);
           $data = array (
              'alcaldias' => $alcaldias,
              'entidades' => $entidades,
              'situacionesjuridicas' => $situacionesjuridicas,
              'tiposituaciones' => $tiposituaciones,
              'centros' => $centros,
              'tipodemandas' => $tipodemandas,
              'resultados' => $resultados,
              'beneficiario' => $beneficiario,
              'escolaridades' => $escolaridades
           );
           return view('expedientes')->with('data', $data);
    });

    //Editar perfil

    Route::get('/editar_perfil/{id}', 'userController@editarPerfil');
Route::get('/establecimientos-registrados-alcaldia-todos', function () {
    return view('alcaldia.establecimientos-registrados-alcaldia-todos');
});
Route::get('/establecimientos-registrados-alcaldia-seleccionados', function () {
    return view('alcaldia.establecimientos-registrados-alcaldia-seleccionados');
});

Route::get('/establecimientos-registrados-alcaldia', function () {
    return view('alcaldia.establecimientos-alcaldias');
});


});

