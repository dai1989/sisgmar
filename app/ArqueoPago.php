<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArqueoPago extends Model
{
    protected $table='arqueo_pagos';

    protected $primaryKey='idarqueo_pago';

    protected $fillable=[
        'idarqueo',
        'idventa',
        'tipo_pago',
        'pago_efectivo',
        'pago_debito',
        'pago_credito',
        'monto',
        'idingreso'
    ];
}
