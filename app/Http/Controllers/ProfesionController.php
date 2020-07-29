<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Profesion;
use Faker\Provider\Person;
use Illuminate\Http\Request;

class ProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Profesion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profesion = new Profesion($request->all());
        $profesion->save();
        return response()->json($profesion,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function show(Profesion $profesion)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profesion = Profesion::find($id);
        $profesion->fill($request->all());
        $profesion->update();
        return response()->json($profesion);
    }
    public function destroy($id)
    {
        $persona = Persona::where('profesion_id',$id)->first();
        if (is_null($persona)){
            $profesion = Profesion::find($id);
            $profesion->delete();
        } else {
            return response()->json(['errors'=>['persona'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json([],204);
    }
}
