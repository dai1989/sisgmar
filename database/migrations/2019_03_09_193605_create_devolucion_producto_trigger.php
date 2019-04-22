<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolucionProductoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('
            CREATE TRIGGER tr_updDevolucionProducto AFTER INSERT ON detalle_devoproductos
            FOR EACH ROW BEGIN
                    UPDATE productos SET stock = stock - NEW.cantidad
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
        DB::unprepared('DROP TRIGGER tr_updDevolucionProducto');
    }
}
