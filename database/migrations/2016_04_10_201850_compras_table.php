<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha_pedidoCompra');
            $table->string('hora_pedidoCompra');
            $table->string('fecha_compra');
            $table->string('hora_compra');
            $table->boolean('confirmado');  //sera false si todavia no se pidio el pedido al proveedor
            $table->boolean('pagado');
            $table->boolean('recibido');
            $table->double('importe_insumos');
            $table->double('importe_costo_envio');  //costo de traer el pedido de insumos a GN Soluciones
            $table->double('importe');
            $table->string('concepto');
            $table->integer('userCompra_id')->unsigned()->nullable();   //usuario que efectua la compra
            $table->foreign('userCompra_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('compras');
    }
}
