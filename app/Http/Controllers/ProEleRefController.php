<?php

namespace App\Http\Controllers;

use App\Estacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\ProEleRef;

class ProEleRefController extends Controller
{
    public function store(Request $request){
        $nowDate = Carbon::now()->toDateString();
        $request->validate([
            'descripcion' => ['required'],
            'fecha' => ['required','after_or_equal:'.$nowDate],
            'fecha_final' => ['required'],
        ]);
        $date = Carbon::parse($request->fecha)->toDateString();
        $request->validate([
            'fecha_final' => 'after_or_equal:'.$date
        ]);

        DB::table('notarios')->update(['contratado'=>0]);
        ProEleRef::create($request->all());
        return response()->json();
    }
    public function index(){
        $procesos=ProEleRef::orderBy('id', 'desc')->get();
        return response()->json($procesos);
    }

    public function update(Request $request, $id){
        $nowDate = Carbon::now()->toDateString();
        $request->validate([
            'descripcion' => ['required'],
            'fecha' => ['required','after_or_equal:'.$nowDate],
            'fecha_final' => ['required'],
        ]);
        $date = Carbon::parse($request->fecha)->toDateString();
        $request->validate([
            'fecha_final' => 'after_or_equal:'.$date
        ]);

        $proEleRef=ProEleRef::find($id);
        if(is_null($proEleRef)) {
            return response()->json(['errors'=>['proceso'=>['Proceso no existe']]], 400);
        }
        if($proEleRef->estado == 0) {
            return response()->json(['errors'=>['proceso'=>['Proceso no se puede actualizar por que ya se concluyo']]], 400);
        }
        $proEleRef->fill($request->all());
        $proEleRef->update();
        return response()->json();
    }
    public function destroy($id){

        $estacion = Estacion::where('pro_ele_ref_id',$id)->first();
        if (is_null($estacion)){
            $proceso = ProEleRef::find($id);
            $proceso->delete();
        } else {
            return response()->json(['errors'=>['proceso'=>['No se puede eliminar, registro en uso']]], 400);
        }
        return response()->json(null,204);
    }
}
