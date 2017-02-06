<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('actividad/createFromProp/{id}',[
  'as' => 'actividad.createFromProp',
  'uses'  => 'ActividadController@createFromPropuesta'
]);

Route::get('/home', 'HomeController@index');
Route::get('/misEventos','EventoController@mis_eventos');
Route::get('/miHorario','AsisteController@mi_horario');
Route::get('/misActividades','ActividadController@mis_actividades');
Route::resource('propuesta', 'PropuestaController');
Route::resource('actividad', 'ActividadController');
Route::resource('evento', 'EventoController');
Route::resource('comite','ComiteController');
Route::resource('evento.actividad','EventoActividadController');
Route::resource('evento.propuesta','EventoPropuestaController');
Route::resource('evento.comite','EventoComiteController');

Route::get('certificado',['uses' => 'CertificadoController@getSingleCertificado']);
Route::get('mis-certificados',['uses' => 'CertificadoController@getMultipleCertificado']);
Route::get('search-activities',['uses' => 'SearcherController@searchActivities']);