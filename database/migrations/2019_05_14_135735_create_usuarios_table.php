<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario',30)->unique();
            $table->string('contrasenia');
            $table->integer('tecnico_id')->unsigned()->nullable();
            $table->integer('coordinador_id')->unsigned()->nullable();
            $table->tinyInteger('nivel_acceso')->unsigned()->nullable();
            $table->foreign('tecnico_id')->references('id')->on('tecnicos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('coordinador_id')->references('id')->on('coordinadores')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}
