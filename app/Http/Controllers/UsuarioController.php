<?php

namespace App\Http\Controllers;

use App\Coordinador;
use App\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Usuario;
use App\Persona;
use phpDocumentor\Reflection\Types\Null_;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios=Usuario::orderBy('id','desc')->get();
        foreach ($usuarios as $usuario){
            unset($usuario->contrasenia);
            if($usuario->tecnico_id){
                $usuario->tecnico= Persona::find($usuario->tecnico_id);
            }
            if($usuario->coordinador_id){
                $usuario->coordinador= Persona::find($usuario->coordinador_id);
            }
        }
        return response($usuarios);
    }
    public function update(Request $request, $id){
        if(is_null($request->contrasenia)){
            unset($request->contrasenia);
        } else {
            $request['contrasenia']=Hash::make($request['contrasenia']);
        }
        $usuario=Usuario::find($id);
        $usuario->fill($request->toArray());
        $tecnico = Tecnico::find($request->funcionario_id);
        $coordinador = Coordinador::find($request->funcionario_id);
        if(!is_null($tecnico)){
            $usuario->tecnico_id = $request->funcionario_id;
            $usuario->coordinador_id = null;

        } elseif(!is_null($coordinador)){
            $usuario->tecnico_id = NULL;
            $usuario->coordinador_id = $request->funcionario_id;
        } else {
            return response()->json(['errors'=>['funcionario'=>['No se encontro al funcionario']]], 400);
        }
        $usuario->update();
        return response(null);
    }
    public function destroy($id)
    {
        $usuario=Usuario::find($id);
        if($usuario->usuario=='admin')return response(null);
        $usuario->delete();
        return response(null);
    }
}
