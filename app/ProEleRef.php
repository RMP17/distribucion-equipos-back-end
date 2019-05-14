<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProEleRef extends Model
{
    protected $table = 'pro_ele_ref';
    protected $fillable = [
        'descripcion',
        'fecha',
    ];
    protected $guarded = [
        'estado'
    ];
    public $timestamps = false;

    public function estaciones(){
        return $this->hasMany(Estacion::class, 'pro_ele_ref_id','id' );
    }
    public function kits(){
        return $this->hasMany(Kit::class, 'pro_ele_ref_id','id' );
    }
    public static function create($parameters){
        $proEleRef=ProEleRef::where('estado', 1)->first();
        if(!is_null($proEleRef)) {
            $proEleRef->estado=0;
            $proEleRef->save();
        }
        $proEleRef= new ProEleRef();
        $proEleRef->fill($parameters);
        $proEleRef->save();
    }
}
