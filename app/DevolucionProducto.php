<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevolucionProducto extends Model
{
    protected $table='devolucion_productos';

    protected $primaryKey='iddevolucionproducto';

    protected $fillable=[
        
        'idusuario',
        'fecha_hora',
        'estado',
        'impuesto',
        'total_venta',
        'observacion'
    ];
}