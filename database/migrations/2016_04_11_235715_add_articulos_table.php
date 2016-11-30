<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('cantidad_insumos');
            $table->string('alto');
            $table->string('ancho');
            $table->string('estado');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');

            $table->integer('color_id')
                ->unsigned()
                ->nullable();
            $table->foreign('color_id')->references('id')->on('colores')->onDelete('cascade');


            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            /*
            $table->integer('material_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materiales')->onDelete('cascade');

            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');

            $table->integer('talle_id')
                ->unsigned()
                ->nullable();
            $table->foreign('talle_id')->references('id')->on('talles')->onDelete('cascade');



            */
            //$table->integer('stock');
            $table->double('costo');
            $table->double('margen');   //%
            $table->double('ganancia'); //$
            $table->double('precioVta');


            $table->string('descripcion',500);

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
        Schema::drop('articulos');
    }
}
