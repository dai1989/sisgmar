<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalleDevoproductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_devoproductos', function (Blueprint $table) {
             $table->increments('iddetalle_devoproductos');
             $table->integer('iddevolucionproducto')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio_venta de productos');
            
           
            
            $table->foreign('iddevolucionproducto')
                  ->references('iddevolucionproducto')->on('devolucion_productos');
            $table->foreign('idproducto')
                  ->references('idproducto')->on('productos');

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
        Schema::dropIfExists('detalle_devoproductos');
    }
}
