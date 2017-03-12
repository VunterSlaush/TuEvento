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
  Route::get('/actividad/{id}/verAsistencia','AsisteController@verAsistencia');
  Route::get('/actividad/{id}/asistencia','AsisteController@descargarAsistencia');
  Route::get('/actividad/{id}/asistir','ActividadController@asistir');
  Route::get('/actividad/{id}/verificarAsistencia',
  ['as' => 'verificarAsistencia', 'uses' => 'ActividadController@verificarAsistencia']);
  Route::resource('asiste', 'AsisteController');
  Route::post('/marcarAsistencia',['as' => 'marcarAsistencia', 'uses' => 'AsisteController@marcarAsistencia']);
  Route::get('califica/pendiente', 'CalificaController@porcalificar')->name('califica.porcalificar');
  Route::get('califica/lista', 'CalificaController@calificada')->name('califica.calificada');
  Route::resource('califica', 'CalificaController');
  Route::resource('comite','ComiteController');
  Route::get('/miPerfil','PerfilController@index');
  Route::post('updateProfile','PerfilController@updateProfile');
  Route::get('/evento/{id_evento}/createEncuesta',['as'=>'createEncuesta','uses'=> 'EventoEncuestaController@createEncuesta']);
  Route::get('/evento/{id_evento}/createPregunta',['as'=>'createPregunta','uses'=> 'EventoEncuestaController@createPregunta']);

  Route::get('/evento/{id_evento}/verEncuestas',['as'=>'verEncuestas','uses'=> 'EventoEncuestaController@verEncuestas']);
  Route::get('/evento/{id_evento}/verPreguntas',['as'=>'verPreguntas','uses'=> 'EventoEncuestaController@verPreguntas']);

  Route::post('/evento/{id_evento}/storeEncuesta',['as'=>'storeEncuesta', 'uses' => 'EventoEncuestaController@storeEncuesta']);
  Route::post('/evento/{id_evento}/storePregunta',['as'=>'storePregunta', 'uses' => 'EventoEncuestaController@storePregunta']);
  Route::get('/actividad/{id_actividad}/responderEncuesta',['as'=>'responderEncuestaActividad',
                                                           'uses' => 'EventoEncuestaController@responderEncuestaActividad']);
  Route::get('/actividad/{id_actividad}/guardarEncuesta',['as'=>'guardarEncuestaActividad',
                                                          'uses' => 'EventoEncuestaController@guardarEncuestaActividad']);
  Route::post('/guardarEncuestaRespuesta',['as'=>'guardarEncuestaRespuestaActividad',
                                                          'uses' => 'EventoEncuestaController@guardarRespuesta']);
  Route::get('/propuesta/{id_propuesta}/seleccionarEncuesta',['as'=>'seleccionarEncuesta',
                                                              'uses' => 'EventoEncuestaController@seleccionarEncuestaEvaluacion']);
  Route::get('/propuesta/{id_propuesta}/evaluar/{id_encuesta}',['as'=>'responderEncuestaPropuesta',
                                                              'uses' => 'EventoEncuestaController@responderEncuestaPropuesta']);

  Route::post('/borrarOpcion',['as'=> 'borrarOpcion', 'uses'=> 'EventoEncuestaController@borrarOpcion']);
  Route::post('/borrarEncuestaPregunta',['as'=> 'borrarEncuestaPregunta', 'uses'=> 'EventoEncuestaController@borrarEncuestaPregunta']);
  Route::post('/borrarPregunta',['as'=> 'borrarPregunta', 'uses'=> 'EventoEncuestaController@borrarPregunta']);
  Route::post('/borrarEncuesta',['as'=> 'borrarEncuesta', 'uses'=> 'EventoEncuestaController@borrarEncuesta']);
  Route::get('/evento/{id_evento}/verAprobados',['as'=>'verAprobados','uses'=> 'EventoController@verListaAprobados']);

  Route::post('/evento/aprobar',['as'=> 'aprobar', 'uses'=> 'EventoController@aprobar']);
  Route::post('/evento/reprobar',['as'=> 'reprobar', 'uses'=> 'EventoController@reprobar']);
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
