<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ProEleRef;

class ProEleRefController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'descripcion' => ['required'],
            'fecha' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        ProEleRef::create($request->all());
        return response()->json();
    }
    public function index(){
        $procesos=ProEleRef::orderBy('id', 'desc')->get();
        return response()->json($procesos);
    }
}
