<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadisticacompraprecioTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('
        CREATE TRIGGER preciocompra AFTER UPDATE ON estadistica_compra
    FOR EACH ROW
    BEGIN
       IF (OLD.precio_compra <> NEW.precio_compra) THEN
         INSERT INTO estadisticacompra_precio(idproducto,precio_compra,precio_anterior,created_at) 
         VALUES (OLD.idproducto,NEW.precio_compra,OLD.precio_compra,NOW());
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
