<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            /*'id
diagnostico_inicial
tipo_mantenimiento
equipo_id
tecnico_id
observaciones
matenimiento_realizado'*/
            $table->increments('id');
            $table->text('diagnostico_inicial')->nullable();
            $table->char('tipo_mantenimiento', 100)->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('mantenimiento_realizado')->default(false);
            $table->unsignedInteger('equipo_id')->nullable();
            $table->unsignedInteger('tecnico_id')->nullable();
            $table->foreign('equipo_id')
                ->references('id')->on('equipos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tecnico_id')
                ->references('id')->on('tecnicos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
}
