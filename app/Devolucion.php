<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    protected $table='devolucions';

    protected $primaryKey='iddevolucion';

    protected $fillable=[
        'num_factura',
        'idcliente',
        'fecha_devolucion',
        'num_comprobante',
        'total_venta'
    ];
}