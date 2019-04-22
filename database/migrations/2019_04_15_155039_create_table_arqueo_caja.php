<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArqueoCaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arqueo_caja', function (Blueprint $table) {
            $table->increments('idarqueo_caja');
            $table->integer('idpresupuesto')->unsigned();
             $table->foreign('idpresupuesto')
                  ->references('idpresupuesto')->on('presupuesto');
              $table->date('fecha_hora');
            
            $table->decimal('monto_ingreso', 10,2);
            $table->decimal('monto_egreso', 10,2);
            $table->string('descripcion', 10,2);

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
        Schema::dropIfExists('arqueo_caja');
    }
}
