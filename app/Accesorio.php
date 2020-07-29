<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    protected $table = 'accesorios';
    protected $fillable = [
        'nombre',
    ];
    protected $guarded = [

    ];
    public $timestamps = false;
}
