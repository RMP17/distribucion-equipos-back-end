<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->char('ci',10);
            $table->char('nombre',30);
            $table->char('apellido1',30);
            $table->char('apellido2',30)->nullable();
            $table->char('extension',3);
            $table->char('celular',10);
            $table->char('empresa_telefonica',10)->nullable();
            $table->char('profesion',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
