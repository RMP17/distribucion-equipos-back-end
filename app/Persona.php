<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = [
        'ci',
        'nombre',
        'apellido1',
        'apellido2',
        'extension',
        'celular',
        'empresa_telefonica',
        'profesion',
    ];
    protected $guarded = [];
    public $timestamps = false;

    public function tecnico(){
        return $this->hasOne(Tecnico::class, 'id','id' );
    }
    public function notario(){
        return $this->hasOne(Notario::class, 'id','id' );
    }
    public function nombreCompleto(){
        $this->nombre= $this->nombre.' '.$this->apellido1.' '.$this->apellido2;
    }
}
