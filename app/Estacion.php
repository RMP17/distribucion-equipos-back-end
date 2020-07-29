<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    protected $table = 'estaciones';
    protected $fillable = [
           'nro_estacion',
           'nro_counter_c',
           'nro_counter_r',
           'tipo_estacion',
           'punto_empadronamiento_id',
    ];
    protected $guarded = [
        'pro_ele_ref_id',
        'direccion',
        'tecnico_id',
        'notario_id',
        'kit_id',
    ];
    public $timestamps = false;

    public function notario(){
        return $this->hasOne(Notario::class, 'id','notario_id' );
    }
    public function puntoEmpadronamiento(){
        return $this->belongsTo(
            PuntoEmpadronamiento::class,
            'punto_empadronamiento_id'
        );
    }
    public function tecnico(){
        return $this->belongsTo(Tecnico::class, 'tecnico_id');
    }
    public function equipos(){
        return $this->belongsToMany(Equipo::class, 'estaciones_equipos','id_estacion', 'id_equipo' )
            ->withPivot(['estado','observacion','observacion_devolucion']);
    }

    public static function create($parameters){
        $stateFunction=(Object)[
            'error'=>false,
            'messages'=>''
        ];
        $proEleRef=ProEleRef::where('estado', 1)->first();
        if(!is_null($proEleRef)){
            $estacion= new Estacion();
            $estacion->fill($parameters);
            $proEleRef->estaciones()->save($estacion);
        } else {
            $stateFunction->error=true;
            $stateFunction->message=['proceso_electoral'=>['Requiere un Proceso Electoral activo']];
        }
        return $stateFunction;
    }
}
