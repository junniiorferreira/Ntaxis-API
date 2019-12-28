<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ==============================

Route::get('/status', 'Api\UsuarioController@status');
Route::namespace('Api')->group( function() {
    Route::post('/usuarios/add', 'UsuarioController@add');
    Route::get('/usuarios', 'UsuarioController@quicklist');
    Route::get('/usuarios/full', 'UsuarioController@list');  
    Route::get('/usuarios/{id}', 'UsuarioController@select');
    Route::put('/usuarios/up/{id}', 'UsuarioController@update');
    Route::delete('/usuarios/del/{id}', 'UsuarioController@delete');

    Route::post('/corridas/ready', 'CorridaController@ready');
    Route::put('/corridas/start/{id}', 'CorridaController@start');
    Route::put('/corridas/checkpoint/{id}', 'CorridaController@checkpoint');
    Route::put('/corridas/finish/{id}', 'CorridaController@setpoint');
});