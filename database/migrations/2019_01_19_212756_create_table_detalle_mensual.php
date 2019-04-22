<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalleMensual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_mensual', function (Blueprint $table) {
            $table->increments('iddetalle_mensual')->comment('id del detalle de la venta mensual');
            $table->integer('idmensual')->unsigned()->comment('relación del detalle de la venta mensual con la venta mensual');
            $table->integer('idproducto')->unsigned()->comment('relación del detalle de la venta mensual con el artículo');
            $table->decimal('cantidad', 11,2)->comment('cantidad de productos');
            $table->decimal('precio_venta', 11,2)->comment('precio venta del producto');
            $table->decimal('descuento', 11,2)->nullable()->nullable()->comment('descuento del producto');
            $table->timestamps();
            $table->foreign('idmensual')
                  ->references('idmensual')->on('mensual');
            $table->foreign('idproducto')
                  ->references('idproducto')->on('productos');
        });
    }

    /**

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_mensual');
    }
}
