<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMensualPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensual_pago', function (Blueprint $table) {
            $table->increments('idmensual_pago');
            $table->integer('idmensual')->unsigned();
             $table->foreign('idmensual')
                  ->references('idmensual')->on('mensual');
              $table->date('fecha_hora');
            $table->decimal('monto', 10,2);     

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
        Schema::dropIfExists('mensual_pago');
    }
}
