<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadisticacompraPrecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadisticacompra_precio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idproducto')->unsigned();
            $table->foreign('idproducto')->references('idproducto')->on('productos');
            $table->string('precio_compra');
            $table->string('precio_anterior');
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
        Schema::dropIfExists('estadisticacompra_precio');
    }
}
