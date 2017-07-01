<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigracionCCorrientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ccorrientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned()->unique();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('debe');
            $table->string('haber');
            $table->string('saldo');

            $table->string('fecha_apertura');
            $table->string('hora_apertura');
            $table->double('saldo_inicial');
            $table->string('fecha_cierre');
            $table->string('hora_cierre');
            $table->boolean('cerrado');
            $table->integer('userApertura_id')->unsigned()->nullable();
            $table->integer('userCierre_id')->unsigned()->nullable();

            $table->foreign('userApertura_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('userCierre_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('ccorrientes');
    }
}
