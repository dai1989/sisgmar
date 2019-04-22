<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevolucionProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucion_productos', function (Blueprint $table) {
            
             $table->increments('iddevolucionproducto');
             $table->integer('idusuario')->unsigned();
            $table->date('fecha_hora');
            $table->decimal('impuesto',4 , 2);
            $table->decimal('total_venta',11 , 2);
            $table->string('estado',20)->comment('id de la estimacion');
            $table->string('observacion',100)->nullable();
           
            $table->foreign('idusuario')
                  ->references('id')->on('users');
          
            
           
           
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
        Schema::dropIfExists('devolucion_productos');
    }
}
