<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_serie');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->integer('banco_id')->unsigned();
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->string('sucursal');
            $table->double('monto');
            $table->string('fecha_emision');
            $table->string('fecha_cobro');
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
        Schema::drop('cheques');
    }
}
