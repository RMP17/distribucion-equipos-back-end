<?php

namespace App;

use App\Http\Controllers\EstacionController;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $fillable = [
//        'modelo',
        'nro_serie',
        'service_tag',
        // tipo de equipo
        // e=equipo; o=otro
        'tipo',
        'marca_id',
        'tipo_equipo_id',
        'codigo_activo',
        'descripcion',
        'origen',
        'observaciones',
        'condicion',
        'modelo_id',
        'estado',
    ];
    protected $guarded = [
        // tipo de estado
        // b=bien; r=en reparacion; d=dañado
        'estado',
    ];

    /*public function accesorios()
    {
        return $this->hasMany(Accesorio::class, 'equipo_id', 'id');
    }*/

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    public function tipoEquipo()
    {
        return $this->belongsTo(TipoEquipo::class, 'tipo_equipo_id');
    }
    public function estaciones(){
        return $this->belongsToMany(
            Estacion::class,
            'estaciones_equipos',
            'id_equipo',
            'id_estacion'
        )->withPivot(['estado','observacion','observacion_devolucion']);
    }
    public function accesorios(){
        return $this->belongsToMany(
            Accesorio::class,
            'equipos_accesorios',
            'equipo_id',
            'accesorio_id'
        );
    }

    public static function newEquipo($parameters)
    {
        $equipo = new Equipo();
        $equipo->fill((array)$parameters);
        $equipo->save();
    }
}
