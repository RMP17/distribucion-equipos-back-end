<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesorios', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tipo_accesorio',50);
            // tipo de estado
            // b=bien; r=en reparacion; d=de baja;
            $table->char('estado',1)->default('b');
            $table->integer('equipo_id')->unsigned();
            $table->foreign('equipo_id')
                ->references('id')
                ->on('equipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesorios');
    }
}
