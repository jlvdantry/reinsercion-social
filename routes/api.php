<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
log::debug('routes/api.php URL='.URL::current().' Request::path()='.\Request::path());

Route::post('register','Auth\RegisterController@register');

Route::post('login', 'Auth\LoginController@login');

Route::post('cambiacontra', 'userController@cambiacontra');
Route::post('restacontra', 'userController@restacontra');
Route::put('userso/{id}', 'userController@update');


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

     Route::get('horarios', 'HorariosController@index');
     Route::post('horarios', 'HorariosController@store');
     Route::delete('horarios/{id}', 'HorariosController@destroy');


     Route::get('users/estadistica', 'userController@estadistica');
     Route::post('boletas', 'inmueblesController@store');
     Route::post('boletas/{id}', 'boletasController@update');
     Route::put('boletas/{id}', 'boletasController@update');
     Route::get('boletas/{id}', 'boletasController@show');

     Route::put('infractores/{boleta}', 'infractoresController@store');
     Route::put('infractores/{boleta}/{id}', 'infractoresController@update');
     Route::post('infractores/{boleta}/{id}', 'infractoresController@update');
     Route::delete('infractores/{id}', 'infractoresController@destroy');

     Route::get('infractores/{boleta}', 'infractoresController@index');
     Route::get('infractores/{boleta}/{id}', 'infractoresController@show');

     Route::get('boletas', 'boletasController@index');
     Route::put('boletas/', 'boletasController@store');
     //Route::post('/sube_archivos', 'fileController@upload');
});
