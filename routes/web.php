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
use App\Entidades;
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

Route::get('/notienecuenta', function () {
    $juzgados = Juzgados::all();
    return view('notienecuenta')->with('juzgados', $juzgados);
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

    Route::get('/expedientes', function () {
        return view('expedientes');
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

    Route::get('/inmuebles-registrados-secretaria/{id}', 'inmueblesController@detalleInmueble');

    Route::get('/inmuebles-registrados/{rfc}', 'inmueblesController@inmueblesByEstablecimientos');


    Route::get('crearexpediente/',  function () {
           $alcaldias = Alcaldias::all();
           $entidades = Entidades::all();
           $jueces = App\User::getJuecesJuzgado(Auth::user()->idjuzgado);
           $secretarios = App\User::getSecretariosJuzgado(Auth::user()->idjuzgado);
           $infracciones = Infracciones::getConcatalogos();
           $data = array (
              'alcaldias' => $alcaldias,
              'entidades' => $entidades,
              'infracciones' => $infracciones,
              'jueces' => $jueces,
              'secretarios' => $secretarios
           );
           return view('crearexpediente')->with('data', $data);
    });
    Route::get('crearexpediente/{id}',  function () {
           $alcaldias = Alcaldias::all();
           $entidades = Entidades::all();
           $infracciones = Infracciones::getConcatalogos();
           $jueces = App\User::getJuecesJuzgado(Auth::user()->idjuzgado);
           $secretarios = App\User::getSecretariosJuzgado(Auth::user()->idjuzgado);
           $data = array (
              'alcaldias' => $alcaldias,
              'entidades' => $entidades,
              'infracciones' => $infracciones,
              'jueces' => $jueces,
              'secretarios' => $secretarios
           );
              return view('crearexpediente')->with('data', $data);
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

