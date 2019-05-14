<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Persona;
use App\Notario;

class NotarioController extends Controller
{
    public function index(){
        $notarios=Persona::join('notarios','personas.id', '=', 'notarios.id')
            ->orderBy('nombre','asc')->get();
        foreach ($notarios as $notario){
            $notario->nombreCompleto();
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
            'apellido1' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
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
            'apellido1' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        Notario::updateData($request->all(), $id);
        return response()->json();
    }
}

