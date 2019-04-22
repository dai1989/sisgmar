<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadisticasCompras extends Model
{
  protected $table='estadistica_compra';

  protected $primaryKey='idestadisticacompra';

  protected $fillable=[
    'idproducto',
    'cantidad',
    'precio_compra',
    'created_at'
  ];
}
