<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEquipo extends Model
{
    protected $table = 'tipos_equipos';
    protected $fillable=['nombre'];
    public $timestamps = false;
}
