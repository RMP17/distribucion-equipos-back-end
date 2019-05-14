<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table='equipos';
    protected $fillable=[
        'descripcion',
        // tipo de equipo
        // e=equipo; o=otro
        'tipo',
        'codigo',
        'modelo',
        'nro_serie',
    ];
    protected $guarded=[
        // tipo de estado
        // b=bien; r=en reparacion; d=de baja;
        'estado',
    ];
    public $timestamps=false;

    public function accesorios(){
        return $this->hasMany(Accesorio::class, 'equipo_id','id' );
    }
    public static function newEquipo($parameters ){
        $equipo = new Equipo();
        $equipo->fill((array)$parameters);
        $equipo->save();
    }
}
