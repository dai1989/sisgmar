<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevolucionDetalle extends Model
{
    protected $table='devolucion_detalles';

    protected $primaryKey='iddevolucion';

    protected $fillable=[
        'idproducto',
        'cantidad',
        'sube_resta',
        'observacion',
        'precio_venta'
    ];
}
