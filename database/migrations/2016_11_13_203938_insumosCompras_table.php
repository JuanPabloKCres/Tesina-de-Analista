<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsumosComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->double('precio_unitario');
            $table->double('importe_insumo');
            $table->double('importe');

            $table->integer('insumo_id')->unsigned();
            $table->integer('compra_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();

            $table->foreign('insumo_id')->references('id')->on('insumos')->onDelete('cascade');
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');

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
        Schema::drop('insumos_compras');
    }
}
