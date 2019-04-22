<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MensualPago extends Model
{
    protected $table = 'mensual_pago';

    protected $primaryKey = 'idmensual_pago';

    protected $fillable = [
        'idmensual',
        'fecha_hora',
        'monto',
        
    ];
}
