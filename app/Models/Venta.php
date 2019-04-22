<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     //
    protected $table = 'venta';
    
    protected $primaryKey= 'idventa';

    public $timestamps = false;

    protected $fillable = [
    	'idcliente',
    	'tipo_comprobante',
    	
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'total_venta',
    	'estado'
    ];

    protected $guarded = [

    	
    ];

     public function persona()
    {
        return $this->belongsTo(\App\Models\Persona::class);
    }
     public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class);
    }
     public function tipopago()
    {
        return $this->belongsTo(\App\Models\TipoPago::class);
    }
     public function tipofactura()
    {
        return $this->belongsTo(\App\Models\TipoFactura::class);
    }
     public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
