<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonalController extends Controller
{
    public function index(){
        $personal = Persona::with('tecnico','notario')->orderBy('id','desc')->get();
        foreach ($personal as $persona){

        }
        return response()->json($personal);
    }
}
