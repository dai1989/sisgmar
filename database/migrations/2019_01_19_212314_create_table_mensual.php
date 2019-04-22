<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMensual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     {
        Schema::create('mensual', function (Blueprint $table) {
            $table->increments('idmensual')->comment('id de la venta mensual');
            $table->integer('persona_id')->unsigned()->comment('relación de la venta mensual con el cliente');
            $table->integer('idusuario')->unsigned()->comment('relación de la venta mensual con el usuario');
            $table->string('tipo_comprobante',30)->nullable()->comment('tipo de comprobante de la venta mensual');
            $table->string('num_comprobante',30)->nullable()->comment('numero de la venta mensual');
            $table->date('fecha_hora')->comment('fecha de la venta mensual');
            $table->decimal('impuesto',4 , 2)->comment('impuesto de la venta mensual');
            $table->decimal('total_venta',11 , 2)->comment('total de la venta mensual');
            $table->string('estado',20)->comment('estado de la venta mensual');
            $table->timestamps();
            $table->integer('tipofactura_id')->unsigned();
            $table->foreign('tipofactura_id')->references('id')->on('tipo_facturas');
            $table->integer('tipopago_id')->unsigned();
            $table->foreign('tipopago_id')->references('id')->on('tipo_pagos');
            $table->foreign('persona_id')
                  ->references('id')->on('personas');
            $table->foreign('idusuario')
                  ->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensual');
    }
}
