<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';
    protected $fillable = [
        'diagnostico_inicial',
        'tipo_mantenimiento',
        'equipo_id',
        'tecnico_id',
        'observaciones'
    ];
}
