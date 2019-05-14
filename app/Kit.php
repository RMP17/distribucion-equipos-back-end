<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $table = 'kits';
    protected $fillable = [
    ];
    protected $guarded = [
        'pro_ele_ref_id',
    ];
    public $timestamps = false;

    public function equipos(){
        return $this->belongsToMany(Equipo::class, 'kits_equipos', 'id_kit', 'id_equipo')->withPivot('estado');
    }

    public static function create(){
        $stateFunction=(Object)[
            'error'=>false,
            'messages'=>''
        ];
        $proEleRef=ProEleRef::where('estado', 1)->first();
        if(!is_null($proEleRef)){
            $kit= new Kit();
            $proEleRef->kits()->save($kit);
        } else {
            $stateFunction->error=true;
            $stateFunction->message=['proceso_electoral'=>['Requiere un Proceso Electoral activo']];
        }
        return $stateFunction;
    }
}
