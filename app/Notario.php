<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notario extends Model
{
    protected $table = 'notarios';
    protected $fillable = [
        'experiencia_procesos_anteriores',
    ];
    protected $guarded = [];
    public $timestamps = false;

    public function persona()
    {
        $this->belongsTo(Persona::class, 'id');
    }
    public function estacion()
    {
        $this->belongsTo(Estacion::class, 'notario_id');
    }
    public static function create($parameters){
        $persona = new Persona();
        $persona->fill($parameters);
        $persona->save($parameters);
        $notario= new Notario();
        $persona->notario()->save($notario);
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
