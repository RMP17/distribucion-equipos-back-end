<?php

namespace App\Http\Controllers;

use App\Estacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Persona;
use App\Notario;

class NotarioController extends Controller
{
    // c=contratado
    public function index(Request $request){
        $notarios=Persona::join('notarios','personas.id', '=', 'notarios.id');
        if ($request->contratado && $request->contratado==='c'){
            $notarios=$notarios->where('notarios.contratado',1);
        }
        $notarios=$notarios->orderBy('nombre','asc')->get();

        foreach ($notarios as $notario){
            $notario->profesion;
        }
        return response()->json($notarios);
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
            'empresa_telefonica' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }
        $persona=Persona::where('ci',$request->ci)->first();
        if (is_null($persona)){
            Notario::create($request->all());
        } else{
            $notario=Notario::find($persona->id);
            if(is_null($notario)) {
                $persona->notario()->save(new Notario());
            } else{
                $message= ['ci'=> [__('validation.unique', ['attribute' => 'Cédula de identidad'])]];
                return response()->json($message, 400);
            }
        }
        return response()->json();
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'ci' => ['required', 'unique:personas,ci,'.$id.',id'],
            'extension' => ['required'],
            'nombre' => ['required'],
            'profesion_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }
        Notario::updateData($request->all(), $id);
        return response()->json();
    }
    public function show($id){
        $notario = Persona::find($id);
        return response()->json($notario);
    }
    public function contratar($id){
        $notario = Notario::find($id);
        $notario->contratado = true;
        $notario->update();
        return response()->json($notario);
    }
    public function destroy($id){
        $estacion = Estacion::where('notario_id',$id)->first();
        if (is_null($estacion)){
            $notario = Notario::find($id);
            $notario->delete();
            $persona= Persona::find($notario->id);
            $persona->delete();
        } else {
            return response()->json(['errors'=>['notario'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json(null,204);
    }
}

