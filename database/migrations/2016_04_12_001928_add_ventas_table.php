<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVentasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha_pedido');
            $table->string('hora_pedido');
            $table->string('fecha_venta');
            $table->string('hora_venta');
            $table->string('iva');
            $table->boolean('pagado');
            $table->boolean('entregado');
            $table->double('senado');
            $table->integer('userPedido_id')->unsigned()->nullable();
            $table->foreign('userPedido_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('userVenta_id')->unsigned()->nullable();
            $table->foreign('userVenta_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('ventas');
    }

}
