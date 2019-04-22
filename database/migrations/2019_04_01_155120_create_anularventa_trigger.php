<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnularventaTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          DB::unprepared('
        CREATE TRIGGER tr_updStockVentaAnular AFTER UPDATE ON venta FOR EACH ROW BEGIN UPDATE productos a JOIN detalle_venta dv 
        ON dv.idproducto = a.idproducto
        AND dv.idventa = NEW.idventa
        SET a.stock = a.stock+dv.cantidad;
                    
                    

               
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
