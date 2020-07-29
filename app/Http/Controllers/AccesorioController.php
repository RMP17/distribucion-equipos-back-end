<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Equipo;
use App\Accesorio;

class AccesorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Accesorio::all());
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
        $request->validate([
            'nombre' => ['required'],
        ]);
        $accesorio = new Accesorio($request->all());
        $accesorio->save();
        return response()->json($accesorio);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accesorios=Equipo::find($id)->accesorios()->orderBy('id','desc')->get();
        return response()->json($accesorios);
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
        $request->validate([
            'nombre' => ['required'],
        ]);
        $accesorio = Accesorio::find($id);
        $accesorio->fill($request->all());
        $accesorio->update();
        return response()->json($accesorio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo_accesorio = DB::table('equipos_accesorios')->where('accesorio_id',$id)->first();
        if (is_null($equipo_accesorio)){
            $accesorios = Accesorio::find($id);
            $accesorios->delete();
        } else {
            return response()->json(['errors'=>['accesorio'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json(null, 204);
    }
}
