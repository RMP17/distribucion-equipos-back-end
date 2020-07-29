<?php

namespace App\Http\Controllers;

use App\Estacion;
use App\PuntoEmpadronamiento;
use Illuminate\Http\Request;

class PuntoEmpadronamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(PuntoEmpadronamiento::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion'=>'unique:puntos_empadronamiento,descripcion'
        ]);
        $punto = new PuntoEmpadronamiento($request->all());
        $punto->save();
        return response()->json($punto,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PuntoEmpadronamiento  $puntoEmpadronamiento
     * @return \Illuminate\Http\Response
     */
    public function show(PuntoEmpadronamiento $puntoEmpadronamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PuntoEmpadronamiento  $puntoEmpadronamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion'=>"unique:puntos_empadronamiento,descripcion,$id,id"
        ]);
        $punto = PuntoEmpadronamiento::find($id);
        $punto->fill($request->all());
        $punto->update();
        return response()->json($punto,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PuntoEmpadronamiento  $puntoEmpadronamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estacion = Estacion::where('punto_empadronamiento_id',$id)->first();
        if (is_null($estacion)){
            $punto = PuntoEmpadronamiento::find($id);
            $punto->delete();
        } else {
            return response()->json(['errors'=>['persona'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json([],204);
    }
}
