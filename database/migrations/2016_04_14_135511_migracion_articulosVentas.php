<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigracionArticulosVentas extends Migration
{

    public function up()
    {
        Schema::create('articulos_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->double('importe');
            $table->double('precio_unitario');
            $table->integer('articulo_id')->unsigned();
            $table->integer('venta_id')->unsigned();

            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('articulos_ventas');
    }
}
