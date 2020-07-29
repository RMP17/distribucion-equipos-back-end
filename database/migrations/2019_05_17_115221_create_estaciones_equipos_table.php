<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionesEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estaciones_equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_estacion')->unsigned();
            $table->integer('id_equipo')->unsigned();
            // tipo de estado
            // b=bien; r=en reparacion; d=dañado
            $table->char('estado',1);
            $table->text('observacion')->nullable();
            $table->text('observacion_devolucion')->nullable();
            $table->foreign('id_estacion')
                ->references('id')->on('estaciones')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_equipo')
                ->references('id')->on('equipos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        DB::statement('ALTER TABLE estaciones_equipos DROP PRIMARY KEY, ADD PRIMARY KEY (id, id_estacion,id_equipo)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estaciones_equipos');
    }
}
