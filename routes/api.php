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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => ['json.response']], function () {

    Route::middleware('auth:api')->get('/users', function (Request $request) {
//        return $request->user();
        return auth()->user();
    });

    // public routes
    Route::post('/login', 'Api\AuthController@login')->name('login.api');
    Route::patch('notario/contratado/{id}', 'NotarioController@contratar');

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Api\AuthController@logout')->name('logout');
        Route::post('/register', 'Api\AuthController@register')->name('register.api');


        Route::prefix('estacion')->group(function () {
            Route::get('/reporte/{id}', 'EstacionController@reporte');
            Route::post('/entregar', 'EstacionController@entregar');
            Route::post('/save-observacion', 'EstacionController@saveObservation');
            Route::get('/equipos/{id_estacion}', 'EstacionController@getEquiposByEstacion');
            Route::post('/add-equipo', 'EstacionController@addEquipoToEstacion');
            Route::patch('/change-estado-equipo', 'EstacionController@changeEstadoEquipo');
            Route::patch('/assign-notario', 'EstacionController@assignNotario');
        });

        Route::apiResource('/users', 'UsuarioController');
    });
});

Route::prefix('kit')->group(function () {
//    Route::get('/equipos/{id_kit}', 'KitController@getEquiposByKit');
//    Route::post('/add-equipo', 'KitController@addEquipoToKit');
});
Route::prefix('equipo')->group(function () {
    Route::patch('change-status/{id}', 'EquipoController@changeStatus');
    Route::get('/nro-serie/{nro_serie}', 'EquipoController@getEquipoByNroSerie');
    Route::patch('/kit/remove', 'EquipoController@removeEquipoOfKit');
});
Route::prefix('estaciones')->group(function () {
    Route::patch('return-equipment/{id_estacion}', 'EstacionController@returnEquipment');
});
Route::apiResource('/equipo', 'EquipoController');
Route::apiResource('/tecnico', 'TecnicoController');
Route::apiResource('/notario', 'NotarioController');
Route::apiResource('coordinadores', 'CoordinadorController');
Route::apiResource('/personal', 'PersonalController');
Route::apiResource('/accesorio', 'AccesorioController');
Route::apiResource('/pro-ele-ref', 'ProEleRefController');
Route::apiResource('/estacion', 'EstacionController');
Route::apiResource('/marcas', 'MarcaController');
Route::apiResource('/kit', 'KitController');

// Nuevas rutas
Route::apiResource('profesiones', 'ProfesionController');
Route::apiResource('puntos', 'PuntoEmpadronamientoController');
Route::apiResource('/tipos-equipos', 'TipoEquipoController');
Route::apiResource('modelos', 'ModeloController');
Route::apiResource('mantenimientos', 'MantenimientoController');
