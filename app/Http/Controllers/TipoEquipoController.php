<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\TipoEquipo;
use Illuminate\Http\Request;

class TipoEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TipoEquipo::all());
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
            'nombre'=>'required'
        ]);
        $tipo = new TipoEquipo($request->all());
        $tipo->save();
        return response()->json($tipo,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function show(TipoEquipo $tipoEquipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'=>'required'
        ]);
        $tipo = TipoEquipo::find($id);
        $tipo->update();
        return response()->json($tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoEquipo  $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::where('tipo_equipo_id',$id)->first();
        if (is_null($equipo)){
            $tipoEquipo = TipoEquipo::find($id);
            $tipoEquipo->delete();
        } else {
            return response()->json(['errors'=>['equipo'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json([],204);
    }
}
