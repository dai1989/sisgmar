<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePresupuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto', function (Blueprint $table) {
            
             $table->increments('idpresupuesto')->comment('id del presupuesto');
              $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->integer('tipofactura_id')->unsigned();
            $table->foreign('tipofactura_id')->references('id')->on('tipo_facturas');
            $table->integer('tipopago_id')->unsigned();
            $table->foreign('tipopago_id')->references('id')->on('tipo_pagos');
            $table->integer('idusuario')->unsigned()->comment('relación del presupuesto con el usuario');

            $table->string('tipo_comprobante',30)->nullable()->comment('tipo de comprobante del presupuesto');
            $table->string('num_comprobante',30)->nullable()->comment('numero del presupuesto');
            $table->date('fecha_hora')->comment('fecha del presupuesto');
            $table->decimal('impuesto',4 , 2)->comment('impuesto del presupuesto');
            $table->decimal('total_venta',11 , 2)->comment('total del presupuesto');
            $table->string('estado',20)->comment('estado del presupuesto');
           $table->foreign('idusuario')
                  ->references('id')->on('users');
                   $table->integer('iddevolucion')->unsigned()->nullable();
            $table->foreign('iddevolucion')->references('iddevolucion')->on('devolucions');
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
        Schema::dropIfExists('presupuesto');
    }
}
