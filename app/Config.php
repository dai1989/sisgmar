<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
  public $timestamps = false;
  protected $table='config';
  protected $primaryKey = 'id';
  protected $fillable=[
            'nombre',
            'imagen',
            'lema',
            'cuit',
            'telefono',
            'correo',
            'campo1',
            'campo2',
            'impuesto',
            'idusuario',
            'alert_minima',
            'alert_maxima',
            'estadistica_diaz',
            'pro_vendidos',
            'pro_recaudacion',
            'menu_mini',
            'direccion',
            'producto_paginate' ,
            'producto_orden',
            'categoria_paginate',
            'categoria_orden',
            'cliente_paginate',
            'cliente_orden',
            'proveedores_paginate',
            'proveedores_orden',
            'usuario_paginate',
            'usuario_orden'
          ];
}
