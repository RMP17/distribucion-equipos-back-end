<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'usuario', 'contrasenia', 'nivel_acceso', 'coordinador_id', 'tecnico_id'
    ];
}

