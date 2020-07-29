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
            // tipo de equipo
            // e=equipo; o=otro
            $table->char('tipo',100);
            $table->char('modelo',30);
            $table->char('nro_serie',50);
            $table->char('service_tag',50)->nullable();
            $table->char('codigo_activo',20)->unique();
            $table->text('descripcion')->nullable();
            $table->text('observaciones')->nullable();
            // Nuevo o Reacondicionado
            $table->char('condicion',30)->nullable();
            // Almacenes o Prestamo
            $table->char('origen',20)->nullable();
            // tipo de estado
            // b=bien; r=en reparacion; d=dañado
            $table->char('estado',1)->default('b');
            $table->unsignedInteger('marca_id')->nullable();
            $table->unsignedInteger('tipo_equipo_id')->nullable();
            $table->foreign('tipo_equipo_id')->references('id')->on('tipos_equipos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')
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
        Schema::dropIfExists('equipos');
    }
}
