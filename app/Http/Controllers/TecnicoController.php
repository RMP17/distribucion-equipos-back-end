<?php

namespace App\Http\Controllers;

use App\Estacion;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tecnico;
use App\Persona;

use Lang;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnicos=Persona::join('tecnicos','personas.id', '=', 'tecnicos.id')
            ->orderBy('nombre','asc')->get();
        foreach ($tecnicos as $tecnico){
            $tecnico->profesion;
        }
        return response()->json($tecnicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            return response()->json(['errors'=>$validator->errors()], 400);
        }
        $persona=Persona::where('ci',$request->ci)->first();
        if (is_null($persona)){
            Tecnico::createTecnico($request->all());
        } else{
            $tecnico=Tecnico::find($persona->id);
            if(is_null($tecnico)) {
                $persona->tecnico()->save(new Tecnico());
            } else{
                $message= ['ci'=> [__('validation.unique', ['attribute' => 'Cédula de identidad'])]];
                return response()->json($message, 400);
            }
        }
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ci' => ['required', 'unique:personas,ci,'.$id.',id'],
            'extension' => ['required'],
            'nombre' => ['required'],
            'profesion_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        Tecnico::updateData($request->all(), $id);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $estacion = Estacion::where('tecnico_id',$id)->first();
        $tecnico = Usuario::where('tecnico_id',$id)->first();
        if (is_null($estacion) && is_null($tecnico)){
            $tecnico = Tecnico::find($id);
            $tecnico->delete();
            $persona= Persona::find($tecnico->id);
            $persona->delete();
        } else {
            return response()->json(['errors'=>['tecnico'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json(null,204);
    }
}
