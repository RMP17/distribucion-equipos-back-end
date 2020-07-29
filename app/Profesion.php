<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table = 'profesiones';
    protected $fillable = [
        'nombre'
    ];
    public $timestamps=false;
}
