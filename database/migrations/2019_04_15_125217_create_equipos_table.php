<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('descripcion',100);
            // tipo de equipo
            // e=equipo; o=otro
            $table->char('tipo',100);
            $table->char('codigo',20)->unique();
            $table->char('modelo',30);
            $table->char('nro_serie',50);
            // tipo de estado
            // b=bien; r=en reparacion; d=de baja;
            $table->char('estado',1)->default('b');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
