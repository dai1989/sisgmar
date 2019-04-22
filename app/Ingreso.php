<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingreso';

    protected $primaryKey='idingreso';

    protected $fillable=[
    	'proveedor_id',
    	'tipo_comprobante',
        'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'estado'
    ];
     public function proveedor()
    {
        return $this->belongsTo(\App\Models\Proveedor::class);
    }
     public function arqueo()
    {
        return $this->belongsTo(\App\Arqueo::class);
    }
}
