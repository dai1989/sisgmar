<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleMensual extends Model
{
    protected $table='detalle_mensual';

    protected $primaryKey='iddetalle_mensual';

    protected $fillable=[
      'idmensual',
      'idproducto',
      'cantidad',
      'precio_venta',
      'descuento'
    ];
}
