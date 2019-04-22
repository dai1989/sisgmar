<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTrigger extends Migration
{
public function up()
    {
          DB::unprepared('
            CREATE TRIGGER tr_updStockIngreso AFTER INSERT ON detalle_ingreso
            FOR EACH ROW BEGIN
                    UPDATE productos SET stock = stock + NEW.cantidad
                    WHERE productos.idproducto = NEW.idproducto;
                    UPDATE productos SET precio_venta = NEW.precio_venta
                    WHERE productos.idproducto = NEW.idproducto;

                     IF EXISTS(SELECT * FROM estadistica_compra WHERE estadistica_compra.idproducto = NEW.idproducto)THEN
                  UPDATE estadistica_compra SET cantidad = cantidad + NEW.cantidad
                  WHERE estadistica_compra.idproducto = NEW.idproducto;
                  UPDATE estadistica_compra SET precio_compra = precio_compra + NEW.precio_compra
                  WHERE estadistica_compra.idproducto = NEW.idproducto;
                ELSE
                  INSERT INTO estadistica_compra (idproducto,cantidad,precio_compra,created_at)
                  VALUES(NEW.idproducto,NEW.cantidad,NEW.precio_compra,NOW());
                END IF;
                END');
    }
    public function down()
    {
       DB::unprepared('DROP TRIGGER tr_updStockIngreso');
    } 
}
