<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigracionMovimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('hora');
            $table->enum('tipo', ['entrada','salida']);
            $table->string('forma');    //EFECTIVO-CHEQUE-CC
            $table->double('monto');
            $table->string('concepto');
            $table->integer('caja_id')->unsigned()->nullable();
            $table->foreign('caja_id')->references('id')->on('cajas')->onDelete('cascade');

            $table->integer('ccorriente_id')->unsigned()->nullable();
            $table->foreign('ccorriente_id')->references('id')->on('ccorrientes')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->integer('venta_id')->unsigned()->nullable();
            $table->integer('compra_id')->unsigned()->nullable();
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


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
        Schema::drop('movimientos');
    }
}
