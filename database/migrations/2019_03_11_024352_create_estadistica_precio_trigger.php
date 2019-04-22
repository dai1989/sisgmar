<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadisticaPrecioTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('
        CREATE TRIGGER estadisticaprecio AFTER UPDATE ON productos
    FOR EACH ROW
    BEGIN
       IF (OLD.precio_venta <> NEW.precio_venta) THEN
         INSERT INTO estadistica_precio(idproducto,marca_id,categoria_id,precio_venta,precio_anterior,fecha_hora,created_at) 
         VALUES (OLD.idproducto,OLD.marca_id,OLD.categoria_id,NEW.precio_venta,OLD.precio_venta,NOW(),NOW());
                END IF;
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
