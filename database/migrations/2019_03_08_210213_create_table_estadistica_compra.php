<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadisticaCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadistica_compra', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('idproducto')->unsigned();
            $table->foreign('idproducto')->references('idproducto')->on('productos');
            $table->string('precio_compra');
            $table->string('cantidad')->nullable();
            $table->string('precio_anterior')->nullable();
            $table->timestamps();
             $table->softDeletes();
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadistica_compra');
    }
}
