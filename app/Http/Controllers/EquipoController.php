<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Equipo;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipo::orderBy('id','desc')->get();
        return response()->json($equipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'codigo' => ['string', 'required','unique:equipos,codigo'],
            'nro_serie' => ['string', 'required','unique:equipos,nro_serie'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        Equipo::newEquipo( (object)$request->all() );
        return response()->json();
    }
    /**
     * getEquipoByNroSerie
     *
     * @param  string  $nro_serie
     * @return \Illuminate\Http\Response
     */
    public function getEquipoByNroSerie($nro_serie)
    {
        $equipo=Equipo::where('nro_serie', $nro_serie)->first();
        return response()->json($equipo);
    }
    /**
     * getEquipoByNroSerie
     *
     * @param  string  $nro_serie
     * @return \Illuminate\Http\Response
     */
    public function removeEquipoOfKit(Request $request)
    {
        DB::table('kits_equipos')->select()
            ->where('id_kit', $request->id_kit)
            ->where('id_equipo', $request->id_equipo)
            ->delete();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
