<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevolucions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucions', function (Blueprint $table) {
            
            $table->increments('iddevolucion');
            $table->integer('idcliente')->unsigned();
          
            
            $table->string('num_factura',30)->nullable();
            $table->string('num_comprobante',30)->nullable();
            $table->decimal('total_venta',11,2)->nullable();
            $table->date('fecha_devolucion');
            $table->foreign('idcliente')
                  ->references('id')->on('personas');
           
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
        Schema::dropIfExists('devoluciones');
    }
}
