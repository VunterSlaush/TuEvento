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

Route::get('/home', 'HomeController@index');
Route::resource('propuesta', 'PropuestaController');
Route::resource('actividad', 'ActividadController');
Route::get('califica/pendiente', 'CalificaController@porcalificar')->name('califica.porcalificar');
Route::get('califica/lista', 'CalificaController@calificada')->name('califica.calificada');
Route::resource('califica', 'CalificaController');