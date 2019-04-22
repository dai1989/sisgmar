<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevolucionProductoDetalle extends Model
{
    protected $table='detalle_devoproductos';

    protected $primaryKey='iddetalle_devoproductos';

    protected $fillable=[
    	'iddevolucionproducto',
        'idproducto',
        'cantidad',
       
         
        'precio_venta'
    ];
}
