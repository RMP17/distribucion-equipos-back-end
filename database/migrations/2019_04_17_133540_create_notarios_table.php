<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notarios', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            // tipo_estacion
            // f=estacion fija; m=estacion movil
            $table->boolean('experiencia_procesos_anteriores')->default('0');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('PERSONAS')
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
        Schema::dropIfExists('NOTARIOS');
    }
}
