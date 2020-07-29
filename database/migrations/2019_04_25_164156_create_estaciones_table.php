<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nro_estacion')->unsigned();
            $table->integer('nro_counter_c')->unsigned();
            $table->integer('nro_counter_r')->unsigned();
            $table->integer('nro_counter_c_final')->unsigned()->nullable();
            $table->integer('nro_counter_r_final')->unsigned()->nullable();
            // tipo de estacion
            // m=movil; f=fija
            $table->char('tipo_estacion', 1);
//            $table->char('direccion', 150)->nullable();
            $table->integer('pro_ele_ref_id')->unsigned();
            $table->integer('punto_empadronamiento_id')->unsigned()->nullable();
            $table->integer('tecnico_id')->unsigned()->nullable();
            $table->integer('notario_id')->unsigned()->nullable();
            $table->dateTime('fecha_hora_entrega')->nullable();
            $table->dateTime('fecha_hora_devolucion')->nullable();
            $table->foreign('punto_empadronamiento_id')
                ->references('id')->on('puntos_empadronamiento')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('pro_ele_ref_id')
                ->references('id')->on('pro_ele_ref')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tecnico_id')
                ->references('id')->on('tecnicos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('notario_id')
                ->references('id')->on('notarios')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estaciones');
    }
}
