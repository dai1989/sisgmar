<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensual extends Model
{
      protected $table='mensual';

      protected $primaryKey='idmensual';

      protected $fillable=[
        'persona_id',
        'tipo_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total_venta',
        'estado',
        'updated_at'
      ];

      public function persona()
    {
        return $this->belongsTo(\App\Persona::class);
    }
}
