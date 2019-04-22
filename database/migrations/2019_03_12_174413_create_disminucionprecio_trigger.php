<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisminucionprecioTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          DB::unprepared('
        CREATE TRIGGER tr_updDisminucionPrecioProducto AFTER INSERT ON disminucion_precio
        FOR EACH ROW BEGIN
                     UPDATE productos SET  precio_venta = precio_venta - NEW.disminucion 
                    WHERE productos.idproducto = NEW.idproducto;
                    UPDATE productos SET  precio_venta = precio_venta - NEW.disminucion 
                    WHERE productos.categoria_id = NEW.categoria_id;
                    UPDATE productos SET  precio_venta = precio_venta - NEW.disminucion
                    WHERE productos.marca_id = NEW.marca_id;
                    

               
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
