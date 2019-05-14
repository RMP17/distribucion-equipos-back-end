<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'tecnicos';
    protected $fillable = [];
    protected $guarded = [];
    public $timestamps = false;
    public function persona(){
        return $this->belongsTo(Persona::class, 'id' );
    }
    public static function create($parameters){
        $persona = new Persona();
        $persona->fill($parameters);
        $persona->save($parameters);
        $tecnico= new Tecnico();
        $persona->tecnico()->save($tecnico);
    }
    public static function updateData($parameters, $id){
        $parameters=(Object)$parameters;
        $persona = Persona::find($id);
        if (!is_null($persona)){
            $persona->fill((Array)$parameters);
            $persona->update();
            /*$tecnico= new Tecnico();
            $persona->tecnico()->save($tecnico);*/
        }
    }
}
