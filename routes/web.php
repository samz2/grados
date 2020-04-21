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
Route::get('/oficio2/{id}','DocumentosController@oficio2');
Route::post('/addDocumento','DocumentosController@store');
Route::get('/getDocumentos','DocumentosController@index');

Route::post('/addEgresado','EgresadoController@store');
Route::get('/getEgresados','EgresadoController@index');
Route::get('/getAlumnos/{d}/{c}/{a}','EgresadoController@show');
Route::get('/getAlumnos','EgresadoController@alumnos');
Route::post('/updateEgresado','EgresadoController@update');
Route::get('/deleteEgresado/{id}','EgresadoController@destroy');

Route::post('/addDocente','DocentesController@store');
Route::post('/updateDocente','DocentesController@update');
Route::get('/getDocentes','DocentesController@index');
Route::get('/getPrincipales','DocentesController@show');

Route::post('/addExpedito','ExpeditobController@store');
Route::post('/addExpeditoT','ExpeditobController@storeTitulo');
Route::get('/getExpeditos','ExpeditobController@index');
Route::get('/updateExpedito/{id}/{tipo}','ExpeditobController@update');
Route::post('/updateExpedito','ExpeditobController@edit');
Route::post('/updateExpeditoT','ExpeditobController@editTitulo');

Route::post('/addTramite','TramiteController@store');
Route::get('/getTramites','TramiteController@index');
Route::post('/updateEstado','TramiteController@update');

Route::post('/addEstado','EstadosController@store');
Route::get('/getEstados','EstadosController@index');
Route::post('/updateEstados','EstadosController@update');

Route::post('/addSesion','SesionController@store');
Route::get('/getSesiones','SesionController@index');
Route::get('/getSessions','SesionController@sessions');
Route::get('/getSession/{num}','SesionController@show');
Route::post('/updateSesion','SesionController@update');


Route::get('/getEscuelas','EscuelasController@index');
Route::post('/addCarrera','EscuelasController@store');
Route::post('/updateCarrera','EscuelasController@update');

Route::post('/addComision','ComisionController@store');
Route::get('/getComisiones','ComisionController@index');
Route::post('/updateComision','ComisionController@update');

Route::post('/addDecano','DecanoController@store');
Route::get('/getDecanos','DecanoController@index');
Route::post('/updateDecano','DecanoController@update');

Route::post('/addModalidad','ModalidadController@store');
Route::get('/getModalidades','ModalidadController@index');
Route::post('/updateModalidad','ModalidadController@update');

Route::post('/addCalificacion','CalificacionController@store');
Route::get('/getCalificaciones','CalificacionController@index');
Route::post('/updateCalificacion','CalificacionController@update');

Route::get('{path}', 'HomeController@index');