<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Kit;
use App\ProEleRef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitController extends Controller
{
    public function index()
    {
        $proEleRef = ProEleRef::where('estado', 1)->first();
        return response()->json($proEleRef->kits);
    }

    public function store()
    {
        $kit = Kit::create();
        if ($kit->error) {
            return response()->json($kit->message, 400);
        }
        return response()->json();
    }

    public function addEquipoToKit(Request $request)
    {

        $kit = Kit::find($request->id);
        $equipo = Equipo::where('nro_serie', $request->nro_serie)->first();

        if (!is_null($kit) && !is_null($equipo)) {
            $kitEquipo = DB::table('kits_equipos')
                ->join('kits', 'kits_equipos.id_kit', '=', 'kits.id')
                ->where('pro_ele_ref_id', $request->pro_ele_ref_id)
                ->where('id_equipo', $equipo->id)
                ->first();
            if (is_null($kitEquipo)) {
                $kit->equipos()->attach($equipo->id, ['estado' => $equipo->estado]);
            } else {
                $error = ['exist' => ['El equipo ya esta registrado en el kit ' . $kitEquipo->id_kit]];
                return response()->json($error, 400);
            }
        } else {
            $error = ['nro_serie' => ['El número de serie no está registrado en ningun equipo']];
            return response()->json($error, 400);
        }
        return response()->json();
    }

    public function getEquiposByKit($id_kit)
    {
        $kitEquipo = DB::table('kits_equipos')->select()
            ->join('equipos', 'kits_equipos.id_equipo', '=', 'equipos.id')
            ->where('id_kit', $id_kit)
            ->addSelect('kits_equipos.estado as estado_kit_equipo')
            ->get();
        foreach ($kitEquipo as $equipo) {
            $equipo->accesorios = DB::table('accesorios')
                ->where('equipo_id', $equipo->id_equipo)
                ->get();
        }
        return response()->json($kitEquipo);
    }

}
