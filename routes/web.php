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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/addUser','UsersController@store');
Route::get('/autenticacion','UsersController@index');
Route::get('/error','UsersController@error');

Route::get('/getAnios','DocumentosController@fechas');
Route::get('/oficio/{id}','DocumentosController@oficio');
Route::post('/addDocumento','DocumentosController@store');
Route::get('/getDocumentos','DocumentosController@index');

Route::post('/addEgresado','EgresadoController@store');
Route::get('/getEgresados','EgresadoController@index');
Route::get('/getAlumnos/{id}','EgresadoController@show');
Route::get('/getAlumnos','EgresadoController@alumnos');
Route::post('/updateEgresado','EgresadoController@update');
Route::get('/deleteEgresado/{id}','EgresadoController@destroy');

Route::post('/addDocente','DocentesController@store');
Route::post('/updateDocente','DocentesController@update');
Route::get('/getDocentes','DocentesController@index');

Route::post('/addExpedito','ExpeditobController@store');
Route::get('/getExpeditos','ExpeditobController@index');
Route::get('/updateExpedito/{id}/{tipo}','ExpeditobController@update');

Route::post('/addTramite','TramiteController@store');
Route::get('/getTramites','TramiteController@index');
Route::post('/updateEstado','TramiteController@update');

Route::post('/addEstado','EstadosController@store');
Route::get('/getEstados','EstadosController@index');
Route::post('/updateEstados','EstadosController@update');

Route::post('/addSesion','SesionController@store');
Route::get('/getSesiones','SesionController@index');
Route::post('/updateSesion','SesionController@update');

Route::get('/getEscuelas','EscuelasController@index');
Route::post('/addCarrera','EscuelasController@store');
Route::post('/updateCarrera','EscuelasController@update');

Route::get('{path}', 'HomeController@index');