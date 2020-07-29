<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Marca::all());
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
        $marca = new Marca($request->all());
        $marca->save();
        return response()->json($marca,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'=>'required'
        ]);
        $marca = Marca::find($id);
        $marca->fill($request->all());
        $marca->update();

        return response()->json($marca);
    }
    public function destroy($id)
    {
        $requipo = Equipo::where('marca_id',$id)->first();
        if (is_null($requipo)){
            $marca = Marca::find($id);
            $marca->delete();
        } else {
            return response()->json(['errors'=>['equipo'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json([],204);
    }
}
