<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Estacion;
use App\Marca;
use App\Modelo;
use App\Notario;
use App\Persona;
use App\ProEleRef;
use App\TipoEquipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Integer;

class EstacionController extends Controller
{
    public function index()
    {
        $proceso = ProEleRef::where('estado', 1)->first();
        if(is_null($proceso)){
            return response()->json( ['errors' => ['proceso_electoral'=>['Requiere un Proceso Electoral activo']]],400);
        }
        $estaciones = Estacion::where('pro_ele_ref_id', $proceso->id)->get();
        foreach ($estaciones as $estacion) {
            $tecnico = $estacion->tecnico;
            $notario = $estacion->notario;
            if ($tecnico) {
                $tecnico = Persona::find($estacion->tecnico->id);
                unset($estacion->tecnico);
                $estacion->tecnico = $tecnico;
            }
            if ($notario) {
                $notario = Persona::find($estacion->notario->id);
                unset($estacion->notario);
                $estacion->notario = $notario;
            }
            $estacion->puntoEmpadronamiento;
//            $estacion->kit;
        }
        return response()->json($estaciones);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nro_estacion' => ['numeric', 'required'],
            'nro_counter_c' => ['numeric', 'required'],
            'nro_counter_r' => ['numeric', 'required'],
            'tipo_estacion' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $proceso = ProEleRef::where('estado',1)->first();
        if(is_null($proceso)){
            return response()->json( ['errors' => ['proceso_electoral'=>['Requiere un Proceso Electoral activo']]],400);
        }

        $existeEstacion = Estacion::where('nro_estacion',$request->nro_estacion)->where('pro_ele_ref_id',$proceso->id)->first();
        if (is_null($existeEstacion)){
            $estacion = Estacion::create($request->all());
        } else {
            return response()->json( ['errors' => ['estacion'=>['Estacion registrada']]],400);
        }
        if ($estacion->error) {
            return response()->json($estacion->message, 400);
        }
        return response()->json();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'nro_estacion' => ['numeric', 'required'],
            'nro_counter_c' => ['numeric', 'required'],
            'nro_counter_r' => ['numeric', 'required'],
            'tipo_estacion' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 400);
        }

        $estacion = Estacion::find($request->id);
        $estacion->fill($request->all());
        $estacion->update();

        return response()->json();
    }

    public function show($idProEleRef)
    {
        $idProEleRef=ProEleRef::where('estado',1)->first();
        if(is_null($idProEleRef)){
            return response()->json( ['errors' => ['proceso_electoral'=>['Requiere un Proceso Electoral activo']]],400);
        }
        $estaciones = Estacion::where('pro_ele_ref_id', $idProEleRef->id)->get();
        foreach ($estaciones as $estacion) {
            $tecnico = $estacion->tecnico;
            $notario = $estacion->notario;
            if ($tecnico) {
                $tecnico = Persona::find($estacion->tecnico->id);
                unset($estacion->tecnico);
                $estacion->tecnico = $tecnico;
            }
            if ($notario) {
                $notario = Persona::find($estacion->notario->id);
                unset($estacion->notario);
                $estacion->notario = $notario;
            }
            $estacion->puntoEmpadronamiento;
//            $estacion->kit;
        }
        return response()->json($estaciones);
    }

    public function getEquiposByEstacion($id_estacion)
    {
        $equiposEstacion = Estacion::find($id_estacion);
        $equiposEstacion = $equiposEstacion->load('equipos');
        foreach ($equiposEstacion->equipos as $equipo) {
            $equipo->accesorios;
            $equipo->tipo_equipo = TipoEquipo::find($equipo->tipo_equipo_id);
            $equipo->marca = Marca::find($equipo->marca_id);
            $equipo->modelo = Modelo::find($equipo->modelo_id);
        }
        return response()->json($equiposEstacion->equipos);
    }

    public function addEquipoToEstacion(Request $request)
    {
        $proceso = ProEleRef::where('estado', 1)->first();
        if(is_null($proceso)){
            return response()->json( ['errors' => ['proceso_electoral'=>['Requiere un Proceso Electoral activo']]],400);
        }
        // $request->nro_serie hace referencia a cualquier codigo, a service tag o codigo de activo
        $estacion = Estacion::find($request->id_estacion);
        if (!is_null($estacion->fecha_hora_devolucion)){
            $error = ['errors'=>['exist' => ['El equipo ya se entrego, No puede agregar dispositivos']]];
            return response()->json($error, 400);
        }
        // solo busca por nro de serie por que puede haber otros codigos que son repetidos
        $equipo = Equipo::where('nro_serie', $request->nro_serie)
            ->orWhere('codigo_activo', $request->nro_serie)
            ->first();

        if (!is_null($estacion) && !is_null($equipo)) {
            $estaciones = Estacion::where('pro_ele_ref_id',$proceso->id)->get();
            $estacionEquipo=null;
            foreach ($estaciones as $_estacion){
                $_estacionEquipo = DB::table('estaciones_equipos')
                    ->where('id_estacion', $_estacion->id)
                    ->where('id_equipo', $equipo->id)
                    ->first();
                if (!is_null($_estacionEquipo)){
                    $estacionEquipo = $_estacionEquipo;
                    break;
                }
            }
            if (is_null($estacionEquipo)) {
                if ($equipo->en_mantenimiento===1){
                    return response()->json( ['errors'=> ['exist' => ['El equipo esta en mantenimiento']]],400);
                } else {
                    $estacion->equipos()->attach($equipo->id, ['estado' => $equipo->estado]);
                }
            } else {
                $error = ['errors'=> ['exist' => ['El equipo ya esta registrado en alguna estación']]];
                return response()->json($error, 400);
            }
        } else {
            $error = ['errors'=> ['nro_serie' => ['El número de serie no está registrado en ningun equipo']]];
            return response()->json($error, 400);
        }
        return response()->json();
    }

    public function changeEstadoEquipo(Request $request)
    {
//      fixme: si el equipo ya se devolvio no se puede cambiar,
        $estacion = Estacion::find($request->id_estacion);
        $equipo = Equipo::find($request->id_equipo);

        if (!is_null($estacion) &&  !is_null($equipo)) {
            DB::table('estaciones_equipos')
                ->where('id_estacion', $request->id_estacion)
                ->where('id_equipo', $request->id_equipo)->update(['estado' => $request->estado]);
            $equipo->estado = $request->estado;
            $equipo->update();
        } else {
            $error = ['id' => ['El equipo no existe o no está registrado en este kit']];
            return response()->json($error, 400);
        }
        return response()->json();
    }

    public function assignNotario(Request $request)
    {
        if (auth()->user() && auth()->user()->tecnico_id) {
            if (is_null($request->notario_id)) {
                $validator = Validator::make($request->all(), [
                    'id_estacion' => ['required'],
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'id_estacion' => ['required'],
//                    'notario_id' => ["unique:estaciones,notario_id,{$request->id_estacion},id"],
                ]);
            }

            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()], 400);
            }

            if (!is_null($request->notario_id)){
                $proceso = ProEleRef::where('estado',1)->first();
                $estacion = Estacion::where('pro_ele_ref_id',$proceso->id)
                    ->where('id','<>',$request->id_estacion)
                    ->where('notario_id',$request->notario_id)->first();
                if(!is_null($estacion)){
                    $error = ['errors'=>['notario' => ['El notoraio ya esta asignado']]];
                    return response()->json($error, 400);
                }
            }

            $estacion = Estacion::find($request->id_estacion);
            if (!is_null($estacion->fecha_hora_devolucion)){
                $error = ['errors'=>['notario' => ['No se puede cambiar notoraio, ya se entrego']]];
                return response()->json($error, 400);
            }
            $notario = Notario::find($request->notario_id);

            if (!is_null($notario)) {
                $estacion->notario_id = $request->notario_id;
            } else {
                $estacion->notario_id = null;
            }
            $estacion->tecnico_id = auth()->user()->tecnico_id;
            $estacion->update();
        } else {
            $error = ['tecnico' => ['Está cuenta no tiene un tecnico asignado']];
            return response()->json($error, 400);
        }
        return response()->json();
    }

    public function saveObservation(Request $request)
    {
        $estacion = Estacion::find($request->id_estacion);
        $equipo = Equipo::find($request->id_equipo);

        if (!is_null($estacion) && !is_null($equipo)) {
            $estacionQueryUpdate= DB::table('estaciones_equipos')
                ->where('id_estacion', $request->id_estacion)
                ->where('id_equipo', $request->id_equipo);
            if (is_null($estacion->fecha_hora_entrega)){
                $estacionQueryUpdate->update(['observacion' => $request->observacion]);
            }else {
                $estacionQueryUpdate->update(['observacion_devolucion' => $request->observacion]);
            }
        } else {
            $error = ['id_estacion' => ['Se requiere id de la estacion e id del equipo']];
            return response()->json($error, 400);
        }
        return response()->json();
    }
    public function entregar(Request $request)
    {
        $request->validate([
            'id_estacion'=>'required',
            'nro_counter_c_final'=>'numeric|integer',
            'nro_counter_r_final'=>'numeric|integer',
        ]);
        $estacion = Estacion::find($request->id_estacion);
        if (!is_null($estacion)) {
            if(is_null($estacion->notario_id)){
                $error = ['errors'=>['estacion' => ['Asigne un notario']]];
                return response()->json($error, 400);
            }

            $estacionEquipo = DB::table('estaciones_equipos')
                ->where('id_estacion', $request->id_estacion)
                ->get();
            if (count($estacionEquipo)<5){
                $error = ['errors'=>['estacion' => ['Debe asignar 5 o mas equipos']]];
                return response()->json($error, 400);
            }

            $dateTime=Carbon::now()->toDateTimeString();
            if (is_null($estacion->fecha_hora_entrega)){
                $estacion->fecha_hora_entrega=$dateTime;
                $estacion->update();
            }elseif(is_null($estacion->fecha_hora_devolucion)) {
                $estacion->fecha_hora_devolucion=$dateTime;
                $estacion->nro_counter_c_final = $request->nro_counter_c_final;
                $estacion->nro_counter_r_final = $request->nro_counter_r_final;
                $estacion->update();
            }else{
                $error = ['errors'=> ['estacion' => ['La estacion ya se entrego']]];
                return response()->json($error, 400);
            }
        } else {
            $error = ['errors'=>['id_estacion' => ['Se requiere id de la estacion e id del equipo']]];
            return response()->json($error, 400);
        }
        return response()->json($estacion);
    }
    public function destroy($id){

        $estacion_equipo = DB::table('estaciones_equipos')->where('id_estacion')->first();
        $estacion = Estacion::find($id);
        if (is_null($estacion->notario_id) && is_null($estacion_equipo)){
            $estacion->delete();
        } else {
            return response()->json(['errors'=>['estacion'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json(null,204);
    }
    public function reporte($idProEleRef)
    {
        $idProEleRef=ProEleRef::find($idProEleRef);
        $estaciones = Estacion::where('pro_ele_ref_id', $idProEleRef->id)->get();
        foreach ($estaciones as $estacion) {
            $tecnico = $estacion->tecnico;
            $notario = $estacion->notario;
            if ($tecnico) {
                $tecnico = Persona::find($estacion->tecnico->id);
                unset($estacion->tecnico);
                $estacion->tecnico = $tecnico;
            }
            if ($notario) {
                $notario = Persona::find($estacion->notario->id);
                unset($estacion->notario);
                $estacion->notario = $notario;
            }
            $estacion->puntoEmpadronamiento;
//            $estacion->kit;
        }
        return response()->json($estaciones);
    }
}
