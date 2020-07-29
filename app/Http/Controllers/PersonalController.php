<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonalController extends Controller
{
    public function index()
    {
        $tecnicos=Persona::join('tecnicos','personas.id', '=', 'tecnicos.id')
            ->orderBy('nombre','asc')->get();
        $coordinadores=Persona::join('coordinadores','personas.id', '=', 'coordinadores.id')
            ->orderBy('nombre','asc')->get();
        foreach ($tecnicos as $tecnico){
            $tecnico->profesion;
        }
        foreach ($coordinadores as $coordinador){
            $coordinador->profesion;
        }
        $mergeCollection = $tecnicos->merge($coordinadores);
        return response()->json($mergeCollection);
    }
}
