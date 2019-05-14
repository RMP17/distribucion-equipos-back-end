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
Route::prefix('kit')->group(function () {
    Route::get('/equipos/{id_kit}', 'KitController@getEquiposByKit');
    Route::post('/add-equipo', 'KitController@addEquipoToKit');
    Route::patch('/change-estado-equipo', 'KitController@changeEstadoEquipo');
});
Route::prefix('equipo')->group(function () {
    Route::get('/nro-serie/{nro_serie}', 'EquipoController@getEquipoByNroSerie');
    Route::patch('/kit/remove', 'EquipoController@removeEquipoOfKit');
});
Route::apiResource('/equipo', 'EquipoController');
Route::apiResource('/tecnico', 'TecnicoController');
Route::apiResource('/notario', 'NotarioController');
Route::apiResource('/personal', 'PersonalController');
Route::apiResource('/accesorio', 'AccesorioController');
Route::apiResource('/pro-ele-ref', 'ProEleRefController');
Route::apiResource('/estacion', 'EstacionController');
Route::apiResource('/kit', 'KitController');

