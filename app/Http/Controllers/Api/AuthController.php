<?php

namespace App\Http\Controllers\Api;

use App\Coordinador;
use App\Persona;
use App\Tecnico;
use Faker\Provider\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Usuario;

class AuthController extends Controller
{
    public function register (Request $request) {

        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|max:255|unique:usuarios,usuario',
            'contrasenia' => 'required|string|min:6',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()], 422);
        }

        $request['contrasenia']=Hash::make($request['contrasenia']);
        $user = new Usuario($request->all());

        $tecnico = Tecnico::find($request->funcionario_id);
        $coordinador = Coordinador::find($request->funcionario_id);
        if(!is_null($tecnico)){
            $user->tecnico_id = $request->funcionario_id;
            $user->coordinador_id = null;

        } elseif(!is_null($coordinador)){
            $user->tecnico_id = NULL;
            $user->coordinador_id = $request->funcionario_id;
        } else {
            return response()->json(['errors'=>['funcionario'=>['No se encontro al funcionario']]], 400);
        }
        $user->save();
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => 'Bearer '.$token];

        return response($response, 200);

    }
    public function login (Request $request) {

        $users=Usuario::count();
        if($users==0){
            $user=Usuario::create([
                'usuario'=>'admin',
                'contrasenia'=>Hash::make('admin')
            ]);
        }else{
            $user = Usuario::where('usuario', $request->usuario)->first();
        }

        if ($user) {

            if (Hash::check($request->contrasenia, $user->contrasenia)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                unset($user->contrasenia);
                $person = Persona::find($user->tecnico_id);
                $user->nombre_completo = "$person->nombre $person->apellido1 $person->apellido2";
                $user->nombre = $person->nombre;
                $response = [
                    'token' => 'Bearer '.$token,
                    'user' => $user
//                    'user' => auth('api')->user()
                ];
                return response($response, 200);
            } else {
                $response = "Password missmatch";
                return response($response, 422);
            }

        } else {
            $response = 'User does not exist';
            return response($response, 422);
        }

    }
    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response($response, 200);

    }
}
