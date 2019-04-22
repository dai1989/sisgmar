<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAumentoproductoPrecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aumentoproducto_precio', function (Blueprint $table) {
            $table->increments('id');

              $table->integer('idproducto')->unsigned()->nullable();
              $table->foreign('idproducto')->references('idproducto')->on('productos');
                   $table->integer('user_id')->unsigned()->nullable();
                   $table->foreign('user_id')->references('id')->on('users');
                   $table->date('fecha_hora');
                   $table->decimal('aumento', 10,2);
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
        Schema::dropIfExists('aumentoproducto_precio');
    }
}
