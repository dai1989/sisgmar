<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAumentoproductoprecioTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('
        CREATE TRIGGER tr_updAumentoPrecioporProducto AFTER INSERT ON aumentoproducto_precio
        FOR EACH ROW BEGIN
                    UPDATE productos SET  precio_venta = precio_venta + NEW.aumento 
                    WHERE productos.idproducto = NEW.idproducto;
                  

               
            END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
