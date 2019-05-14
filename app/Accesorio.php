<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    protected $table = 'accesorios';
    protected $fillable = [
        'tipo_accesorio',
    ];
    protected $guarded = [
        // tipo de estado
        // b=bien; r=en reparacion; d=de baja;
        'estado',
        'equipo_id',
    ];
    public $timestamps = false;

    public static function create($parameters)
    {
        $parameters=(Object)$parameters;
        $equipo = Equipo::find($parameters->equipo_id);
        $accesorio = new Accesorio();
        $accesorio->fill((Array)$parameters);
        $equipo->accesorios()->save($accesorio);
    }
}
