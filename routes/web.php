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
Route::resource('asiste', 'AsisteController');
Route::resource('evento', 'EventoController');
Route::resource('comite','ComiteController');
Route::get('/certificado/{codigo}',['uses' => 'CertificadoController@getCertificado']);
Route::get('/misCertificados',['uses' => 'CertificadoController@verCertificados']);
Route::resource('evento.actividad','EventoActividadController');
Route::resource('evento.propuesta','EventoPropuestaController');
Route::resource('evento.comite','EventoComiteController');
Route::get('/actividad/{id}/asistir','ActividadController@asistir');
Route::get('/actividad/{id}/verificarAsistencia',
['as' => 'verificarAsistencia', 'uses' => 'ActividadController@verificarAsistencia']);
Route::post('marcarAsistencia',['as' => 'marcarAsistencia', 'uses' => 'AsisteController@marcarAsistencia']);
Route::get('certificado',['uses' => 'CertificadoController@getSingleCertificado']);
Route::get('mis-certificados',['uses' => 'CertificadoController@getMultipleCertificado']);
Route::get('califica/pendiente', 'CalificaController@porcalificar')->name('califica.porcalificar');
Route::get('califica/lista', 'CalificaController@calificada')->name('califica.calificada');
Route::resource('califica', 'CalificaController');
