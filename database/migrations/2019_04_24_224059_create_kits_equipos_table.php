<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitsEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kits_equipos', function (Blueprint $table) {
            $table->integer('id_kit')->unsigned();
            $table->integer('id_equipo')->unsigned();
            // tipo de estado
            // b=bien; r=en reparacion; d=de baja;
            $table->char('estado',1);
            $table->primary(['id_kit', 'id_equipo']);
            $table->foreign('id_kit')
                ->references('id')->on('kits')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_equipo')
                ->references('id')->on('equipos')
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
        Schema::dropIfExists('kits_equipos');
    }
}
