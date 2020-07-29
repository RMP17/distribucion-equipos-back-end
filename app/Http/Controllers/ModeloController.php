<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Modelo::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelo =  new Modelo($request->all());
        $modelo->save();
        return response()->json($modelo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = Modelo::find($id);
        $modelo->fill($request->all());
        $modelo->update();
        return response()->json($modelo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::where('modelo_id',$id)->first();
        if (is_null($equipo)){
            $modelo = Modelo::find($id);
            $modelo->delete();
        } else{
            return response()->json(['errors'=>['modelo'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json([],204);
    }
}
