<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProEleRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_ele_ref', function (Blueprint $table) {
            $table->increments('id');
            $table->char('descripcion',200);
            $table->date('fecha');
            $table->date('fecha_final')->nullable();
            $table->char('tipo',100)->nullable();
            $table->boolean('estado')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_ele_ref');
    }
}
