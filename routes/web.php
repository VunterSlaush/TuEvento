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


Route::group(['middleware' => 'auth'], function ()
{

  Route::get('/misEventos','EventoController@mis_eventos');
  Route::get('evento/{id}/organizar','EventoController@organizar')->name('evento.organizar');
  Route::get('/miHorario','AsisteController@mi_horario');
  Route::get('/misActividades','ActividadController@mis_actividades');
  Route::get('/misCertificados',['uses' => 'CertificadoController@verCertificados']);
  Route::get('/actividad/{id}/asistir','ActividadController@asistir');
  Route::get('/actividad/{id}/verificarAsistencia',
  ['as' => 'verificarAsistencia', 'uses' => 'ActividadController@verificarAsistencia']);
  Route::resource('asiste', 'AsisteController');
  Route::post('marcarAsistencia',['as' => 'marcarAsistencia', 'uses' => 'AsisteController@marcarAsistencia']);
  Route::get('califica/pendiente', 'CalificaController@porcalificar')->name('califica.porcalificar');
  Route::get('califica/lista', 'CalificaController@calificada')->name('califica.calificada');
  Route::resource('califica', 'CalificaController');
  Route::resource('comite','ComiteController');
  Route::get('/miPerfil','PerfilController@index');
  Route::post('updateProfile','PerfilController@updateProfile');
});


Route::get('/home', 'EventoController@index');
Route::get('/searchEvento/{search}','SearcherController@searchEvento')->where('search', '(.*)');
Route::get('/searchActividad/{search}','SearcherController@searchActividad')->where('search', '(.*)');
Route::resource('propuesta', 'PropuestaController');
Route::resource('actividad', 'ActividadController');
Route::resource('evento', 'EventoController');
Route::get('/certificado/{codigo}',['uses' => 'CertificadoController@getCertificado']);
Route::get('/certificadoEvento/{cedula}-{evento}',
[ 'as' => 'certificadoEvento',
  'uses' => 'CertificadoController@getCertificadoEvento']);
Route::resource('evento.actividad','EventoActividadController');
Route::resource('actividad.presentador','ActividadPresentadorController');
Route::resource('evento.propuesta','EventoPropuestaController');
Route::resource('evento.comite','EventoComiteController');
Route::resource('evento.jurado','EventoJuradoController');

Route::post('/deleteJuradoArea','EventoJuradoController@deleteAreaJurado');

Route::post('stateUpdate','EventoController@stateUpdate');
Route::post('areaUpdate','EventoController@areaUpdate');
Route::post('areaDelete','EventoController@areaDelete');

Route::post('tipoUpdate','EventoController@tipoUpdate');
Route::post('tipoDelete','EventoController@tipoDelete');

Route::post('/schedulerUpdate','ActividadController@schedulerUpdate');

Route::get('/users/{param}','SearcherController@searchUsers');
Route::get('/users/{param}/{actividad}','SearcherController@searchUsersNoAsistentes');
Route::get('/usersPresentador/{param}/{actividad}','SearcherController@searchUsersNoPresentadores');
Route::get('/usersEventoJurado/{param}/{evento}','SearcherController@searchUsersNoJurado');
Route::get('/usersEventoComite/{param}/{evento}','SearcherController@searchUsersNoComite');


Route::get('/search-activities','SearcherController@searchActivities');
