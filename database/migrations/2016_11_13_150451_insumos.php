<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Insumos extends Migration
{
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->double('stock');
            $table->double('stockMinimo');
            $table->double('costo');
            $table->double('costo_anterior')->nullable();   //costo compra anterior
            $table->string('alto');
            $table->string('ancho');

            $table->integer('talle_id')->unsigned()->nullable();
            $table->foreign('talle_id')->references('id')->on('talles')->onDelete('cascade');
            $table->integer('material_id')->unsigned()->nullable();
            $table->foreign('material_id')->references('id')->on('materiales')->onDelete('cascade');

            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colores')->onDelete('cascade');

            $table->integer('unidad_medida_id')->unsigned()->nullable();
            $table->foreign('unidad_medida_id')->references('id')->on('unidades_medidas')->onDelete('cascade');
            $table->string('descripcion');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('insumos');
    }
}
