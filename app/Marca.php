<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
    protected $fillable = ['nombre'];
    public $timestamps = false;
    public function equipos(){
        return $this->hasMany(Equipo::class, 'marca_id', 'id');
    }
}
