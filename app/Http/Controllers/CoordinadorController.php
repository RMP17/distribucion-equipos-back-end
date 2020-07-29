<?php

namespace App\Http\Controllers;

use App\Coordinador;
use App\Estacion;
use App\Persona;
use App\Tecnico;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coodinadores=Persona::join('coordinadores','personas.id', '=', 'coordinadores.id')
            ->orderBy('nombre','asc')->get();
        foreach ($coodinadores as $coordinador){
            $coordinador->profesion;
        }
        return response()->json($coodinadores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ci' => ['required'],
            'extension' => ['required'],
            'nombre' => ['required'],
            'profesion_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $persona=Persona::where('ci',$request->ci)->first();
        if (is_null($persona)){
            $persona = new Persona();
            $persona->fill($request->all());
            $persona->save();
            $persona->coordinador()->save(new Coordinador());
        } else{
            $coordinador=Coordinador::find($persona->id);
            if(is_null($coordinador)) {
                $persona->coordinador()->save(new Coordinador());
            } else{
                $message= ['ci'=> [__('validation.unique', ['attribute' => 'Cédula de identidad'])]];
                return response()->json($message, 400);
            }
        }

        return response()->json($persona,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinador $coordinador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $persona = Persona::find($id);
        if (!is_null($persona)){
            $persona->fill($request->all());
            $persona->update();
        }
        return response()->json($persona);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $coordinador = Usuario::where('coordinador_id',$id)->first();
        if (is_null($coordinador)){
            $coordinador = Coordinador::find($id);
            $coordinador->delete();
            $persona= Persona::find($coordinador->id);
            $persona->delete();
        } else {
            return response()->json(['errors'=>['coordinador'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json(null,204);
    }
}
