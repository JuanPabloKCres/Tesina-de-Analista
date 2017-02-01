<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigracionConfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                        
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('cuit');
            $table->string('telefono');
            $table->string('email');
            $table->string('direccion');
            $table->string('imagen');
            $table->integer('responiva_id')->unsigned();
            $table->foreign('responiva_id')->references('id')->on('responiva')->onDelete('cascade');
            $table->integer('localidad_id')->unsigned();            

            $table->foreign('localidad_id')->references('id')->on('localidades')->onDelete('cascade');
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
        Schema::drop('configs');
    }
}
