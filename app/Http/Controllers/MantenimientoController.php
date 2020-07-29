<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Mantenimiento;
use App\Persona;
use App\Tecnico;
use Faker\Provider\Person;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return voidd
     */
    //  filter toma los pm= dispositivos por realizar mantenimiento; mr=mantenimientos realizados
    public function index(Request $request)
    {
        $mantenimientos = Mantenimiento::select();
        if (!is_null($request->filter) && $request->filter=='pm') {
            $mantenimientos = $mantenimientos->where('mantenimiento_realizado', 0);
        } else if (!is_null($request->filter) && $request->filter=='mr'){
            $mantenimientos = $mantenimientos->where('mantenimiento_realizado', 1);
        }
        $mantenimientos = $mantenimientos->orderBy('created_at', 'desc')->get();
        foreach ($mantenimientos as $mantenimiento) {
            $mantenimiento->tecnico = Persona::find($mantenimiento->tecnico_id);
            $quipo = Equipo::find($mantenimiento->equipo_id);
            $quipo->marca;
            $quipo->modelo;
            $quipo->tipoEquipo;
            $mantenimiento->equipo = $quipo;
        }
        return response()->json($mantenimientos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mantenimiento = new Mantenimiento($request->all());
        $mantenimiento->save();

        $equipo = Equipo::find($request->equipo_id);
        if ($equipo->en_mantenimiento===0){
            $equipo->en_mantenimiento = true;
            $equipo->update();
        } else {
            return response()->json(['errors'=>['equipo'=>['El equipo ya esta en mantenimiento']]],400);
        }

        return response()->json($mantenimiento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::find($id);
        $mantenimiento->mantenimiento_realizado = true;
        $mantenimiento->mantenimiento_realizado = true;
        $mantenimiento->update();

        $equipo = Equipo::find($mantenimiento->equipo_id);
        $equipo->en_mantenimiento = false;
        $equipo->estado = 'b';
        $equipo->update();

        return response()->json($mantenimiento);
    }

}
