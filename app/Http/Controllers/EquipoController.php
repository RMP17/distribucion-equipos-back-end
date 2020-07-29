<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    //  filter toma los a= dispositivos asignados; na=dispositivos no asignados
    public function index(Request $request)
    {
        $filter = $request->filter;
        // selecciona a equipos que estan en mantenimiento
        $equipos = Equipo::select()->where('en_mantenimiento', 0);
        if (!is_null($filter) && $filter == 'a') {
            $equipos = $equipos->whereHas('estaciones');
        } else if (!is_null($filter) && $filter == 'na') {
            $equipos = $equipos->doesntHave('estaciones');
        } else if (!is_null($filter) && $filter == 're') {
            $equipos = $equipos->where('estado','r');
        }
        $equipos = $equipos->orderBy('id', 'desc')->get();
        foreach ($equipos as $equipo) {
            $equipo->marca;
            $equipo->tipoEquipo;
            $equipo->modelo;
            $equipo->accesorios;
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_activo' => ['string', 'required', 'unique:equipos,codigo_activo'],
            'nro_serie' => ['string', 'required', 'unique:equipos,nro_serie'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $idsAccesorios = collect($request->accesorios)->map(function ($value) {
            return $value['id'];
        });
        $equipo = new Equipo();
        $equipo->fill($request->all());
        $equipo->save();
        $equipo->accesorios()->attach($idsAccesorios);

        return response()->json();
    }

    /**
     * getEquipoByNroSerie
     *
     * @param string $nro_serie
     * @return \Illuminate\Http\Response
     */
    public function getEquipoByNroSerie($nro_serie)
    {
        $equipo = Equipo::where('nro_serie', $nro_serie)->first();
        if($equipo){
            $equipo->tipoEquipo;
        } else {
            return response()->json(null);
        }
        return response()->json($equipo);
    }

    /**
     * getEquipoByNroSerie
     *
     * @param string $nro_serie
     * @return \Illuminate\Http\Response
     */
    public function removeEquipoOfKit(Request $request)
    {
        DB::table('estaciones_equipos')
            ->where('id_estacion', $request->id_estacion)
            ->where('id_equipo', $request->id_equipo)
            ->delete();
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existeEquipo = DB::table('estaciones_equipos')->where('id_equipo', $id)->first();
        if (!is_null($existeEquipo)) {
            return response()->json(['errors' => ['equipo' => ['No se puede cambiar los datos, registro en uso']]], 400);
        }
        $validator = Validator::make($request->all(), [
            'codigo_activo' => ['string', 'required', "unique:equipos,codigo_activo,$id,id"],
            'nro_serie' => ['string', 'required', "unique:equipos,nro_serie,$id,id"],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $idsAccesorios = collect($request->accesorios)->map(function ($value) {
            return $value['id'];
        });
        DB::table('equipos_accesorios')->where('equipo_id',$id)->delete();
        $equipo = Equipo::find($id);
        if ($equipo){
            $equipo->fill($request->all());
            $equipo->save();
            $equipo->accesorios()->attach($idsAccesorios);
        }
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existeEquipo = DB::table('estaciones_equipos')->where('id_equipo', $id)->first();
        if (is_null($existeEquipo)){
            $equipo = Equipo::find($id);
            $equipo->delete();
        } else{
            return response()->json(['errors'=>['modelo'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json([],204);
    }

    public function changeStatus(Request $request, $id)
    {
        $equipo = Equipo::find($id);
        $equipo->estado = $request->estado;
        $equipo->update();
        return response()->json($equipo);
    }
}
