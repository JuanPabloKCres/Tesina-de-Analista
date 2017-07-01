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
            $table->string('fecha_entrega_estimada')->nullable();   //Fecha en la que se terminaria de producir el pedido del cliente
            $table->string('fecha_venta')->nullable();
            $table->string('hora_venta')->nullable();

            $table->string('fecha_facuracion')->nullable();
            $table->string('hora_facturacion')->nullable();
            $table->string('nro_cae')->nullable();          //te lo da AFIP via Factura electronica
            $table->string('f_ven_cae')->nullable();          //te lo da AFIP via Factura electronica

            $table->string('nro_facturero')->nullable();    //lo asigna el usuario segun su factura manual en papel

            $table->boolean('pagado');
            $table->boolean('entregado');
            $table->double('senado');
            $table->integer('cheque_id')->unsigned()->nullable();
            $table->foreign('cheque_id')->references('id')->on('cheques')->onDelete('cascade');
            $table->integer('userPedido_id')->unsigned()->nullable();
            $table->foreign('userPedido_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('userVenta_id')->unsigned()->nullable();
            $table->foreign('userVenta_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->double('horas_produccion');
            $table->double('progreso');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('ventas');
    }

}
