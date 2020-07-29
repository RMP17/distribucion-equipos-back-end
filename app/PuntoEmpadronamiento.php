<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntoEmpadronamiento extends Model
{
    protected $table = 'puntos_empadronamiento';
    protected $fillable = ['descripcion'];
    public $timestamps = false;
}
