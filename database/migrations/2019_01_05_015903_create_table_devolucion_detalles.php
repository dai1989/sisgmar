<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevolucionDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucion_detalles', function (Blueprint $table) {
            $table->increments('iddevolucion_detalle');
             $table->integer('iddevolucion')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio_venta de productos');
            
            $table->string('observacion',100)->nullable();
            $table->string('sube_resta');
            $table->foreign('iddevolucion')
                  ->references('iddevolucion')->on('devolucions');
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
        Schema::dropIfExists('devolucion_detalles');
    }
}
