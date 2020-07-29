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
        'profesion_id'
    ];
    protected $guarded = [];
    public $timestamps = false;
    protected $appends = ['nombre_completo'];

    public function tecnico(){
        return $this->hasOne(Tecnico::class, 'id','id' );
    }
    public function profesion(){
        return $this->belongsTo(Profesion::class, 'profesion_id');
    }
    public function notario(){
        return $this->hasOne(Notario::class, 'id','id' );
    }
    public function coordinador(){
        return $this->hasOne(Coordinador::class, 'id','id' );
    }
    public function getNombreCompletoAttribute()
    {
        return "$this->nombre $this->apellido1 $this->apellido2";
    }
}
