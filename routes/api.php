<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
log::debug('routes/api.php URL='.URL::current().' Request::path()='.\Request::path());

Route::post('register','Auth\RegisterController@register');

Route::post('login', 'Auth\LoginController@login');

Route::post('cambiacontra', 'userController@cambiacontra');
Route::post('restacontra', 'userController@restacontra');
//Route::put('userso/{id}', 'userController@update');


Route::group(['middleware' => 'auth:web'], function() {
     log::debug('routes/api.php entro en middleware path'.\Request::path());
     Route::put('users/{id}', 'userController@update');
     Route::get('users', 'userController@index');

     Route::get('grupo_actividades', 'GrupoActividadesController@index');
     Route::post('grupo_actividades', 'GrupoActividadesController@store');
     Route::delete('grupo_actividades/{id}', 'GrupoActividadesController@destroy');

     Route::get('beneficiarios', 'BeneficiariosController@index');
     Route::get('beneficiarios/{id}', 'BeneficiariosController@show');
     Route::put('beneficiarios/{id}', 'BeneficiariosController@update');
     Route::post('beneficiarios', 'BeneficiariosController@store');
     Route::delete('beneficiarios/{id}', 'BeneficiariosController@destroy');


     Route::get('tiposituaciones/0/{id}', 'TiposituacionesController@indexporsituacion');

     Route::get('actividades', 'ActividadesController@index');
     Route::get('actividades/0/{id}', 'ActividadesController@indexporgrupo');
     Route::post('actividades', 'ActividadesController@store');
     Route::delete('actividades/{id}', 'ActividadesController@destroy');

     Route::delete('demandas/{id}', 'DemandasController@destroy');

     Route::get('horarios', 'HorariosController@index');
     Route::post('horarios', 'HorariosController@store');
     Route::delete('horarios/{id}', 'HorariosController@destroy');


     Route::get('users/estadistica', 'userController@estadistica');
     Route::post('expedientes/{id}', 'ExpedientesController@update');
     Route::put('expedientes/{id}', 'ExpedientesController@update');
     Route::get('expedientes/0/{idusuario}', 'ExpedientesController@indexporusuario');
     Route::get('expedientes/{id}', 'ExpedientesController@show');
     Route::delete('expedientes/{id}', 'ExpedientesController@destroy');

     Route::get('expedientes', 'ExpedientesController@index');
     Route::put('expedientes/', 'ExpedientesController@store');
});
