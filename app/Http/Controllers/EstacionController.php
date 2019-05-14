<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Estacion;
use App\ProEleRef;
use App\Persona;
use App\Notario;

class EstacionController extends Controller
{
    public function index(){
        $proceso=ProEleRef::where('estado',1)->first();
        $estaciones=Estacion::where('pro_ele_ref_id',$proceso->id)->get();
        foreach ($estaciones as $estacion) {
            $tecnico=$estacion->tecnico;
            $notario=$estacion->notario;
            if($tecnico){
                $tecnico=Persona::find($estacion->tecnico->id);
                unset($estacion->tecnico);
                $estacion->tecnico=$tecnico;
                $estacion->tecnico->nombre_completo=$tecnico->nombre.' '.$tecnico->apellido1.' '.$tecnico->apellido2;
            }
            if($notario){
                $notario=Persona::find($estacion->notario->id);
                unset($estacion->notario);
                $estacion->notario=$notario;
                $estacion->notario->nombre_completo=$notario->nombre.' '.$notario->apellido1.' '.$notario->apellido2;
            }
            $estacion->kit;
        }
        return response()->json($estaciones);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nro_estacion' => ['numeric', 'required','unique:estaciones,nro_estacion'],
            'nro_counter_c' => ['numeric', 'required'],
            'nro_counter_r' => ['numeric', 'required'],
            'tipo_estacion' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $estacion= Estacion::create($request->all());
        if($estacion->error){
            return response()->json($estacion->message,400);
        }
        return response()->json();
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'direccion' => ['required'],
            'tecnico_id' => ['required',"exists:tecnicos,id"],
            'notario_id' => ['required',"unique:estaciones,notario_id,{$request->id},id"],
            'kit_id' => ['required',"exists:kits,id","unique:estaciones,kit_id,{$request->id},id"],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $notario = Notario::find($request->notario_id);
        $notario->experiencia_procesos_anteriores=1;
        $notario->update();
        $estacion=Estacion::find($request->id);
        $estacion->direccion=$request->direccion;
        $estacion->tecnico_id=$request->tecnico_id;
        $estacion->notario_id=$request->notario_id;
        $estacion->kit_id=$request->kit_id;
        $estacion->update();

        return response()->json();
    }
    public function show($idProEleRef){
        $estaciones=Estacion::where('pro_ele_ref_id',$idProEleRef)->get();
        return response()->json($estaciones);
    }
}
