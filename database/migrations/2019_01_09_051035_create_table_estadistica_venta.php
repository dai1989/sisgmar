<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadisticaVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
   {
        Schema::create('estadistica_venta', function (Blueprint $table) {
            $table->increments('id_estadistica')->comment('id de la estadistica');
            $table->integer('idproducto')->unsigned()->comment('relación de los articulos con la estadistica');
            $table->string('cantidad')->comment('cantidad de productos');
            $table->string('precio_venta')->comment('precio venta de cada producto');
            $table->timestamps();
            $table->foreign('idproducto')
                  ->references('idproducto')->on('productos');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadistica_venta');
    }
}
