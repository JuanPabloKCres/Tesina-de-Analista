<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsumosArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos_articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('cantidad');

            $table->double('precio_unitario');  //costo de uno
            $table->double('importe_insumo');   //costo x cantidad solo ese insumo

            $table->integer('insumo_id')->unsigned();
            $table->integer('articulo_id')->unsigned();

            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            $table->foreign('insumo_id')->references('id')->on('insumos')->onDelete('cascade');
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
        Schema::drop('insumos_articulos');
    }
}
