<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadisticaPrecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadistica_precio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idproducto')->unsigned()->nullable();
            $table->foreign('idproducto')->references('idproducto')->on('productos');
            $table->integer('marca_id')->unsigned()->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->string('precio_venta');
            $table->string('precio_anterior');
            $table->date('fecha_hora');
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
        Schema::dropIfExists('estadistica_precio');
    }
}
