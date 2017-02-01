<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigracionAuditorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tabla');
            $table->integer('elemento_id');
            $table->string('accion');
            $table->string('dato_nuevo')->unsigned()->nullable();
            $table->string('dato_anterior')->unsigned()->nullable();
            $table->integer('usuario_id')->unsigned();
            //$table->foreign('usuairo_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('auditorias');
    }
}
