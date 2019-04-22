<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDisminucionPrecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disminucion_precio', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('idproducto')->unsigned()->nullable();
              $table->foreign('idproducto')->references('idproducto')->on('productos');
                   $table->integer('user_id')->unsigned();
                   $table->foreign('user_id')->references('id')->on('users');
                    $table->integer('marca_id')->unsigned()->nullable();
                   $table->foreign('marca_id')->references('id')->on('marcas');
                   $table->integer('categoria_id')->unsigned()->nullable();
                   $table->foreign('categoria_id')->references('id')->on('categorias'); 
                  $table->date('fecha_hora');
                   $table->decimal('disminucion', 10,2);
                   
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
        Schema::dropIfExists('disminucion_precio');
    }
}
