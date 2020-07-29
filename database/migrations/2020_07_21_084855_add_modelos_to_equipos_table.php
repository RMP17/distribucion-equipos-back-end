<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModelosToEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->dropColumn('modelo');
            $table->unsignedInteger('modelo_id')->nullable();
            $table->foreign('modelo_id')
                ->references('id')
                ->on('modelos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipos', function (Blueprint $table) {
            $table->char('modelo',30);
            $table->dropForeign(['modelo_id']);
            $table->dropColumn('modelo_id');
        });
    }
}
