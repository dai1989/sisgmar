<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EstadisticaPrecio
 * @package App\Models
 * @version March 11, 2019, 7:47 pm -03
 *
 * @property \App\Models\Producto producto
 * @property \Illuminate\Database\Eloquent\Collection aumentoPrecio
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection detalleDevoproductos
 * @property \Illuminate\Database\Eloquent\Collection detalleEstimacion
 * @property \Illuminate\Database\Eloquent\Collection detalleIngreso
 * @property \Illuminate\Database\Eloquent\Collection detalleMensual
 * @property \Illuminate\Database\Eloquent\Collection detallePresupuesto
 * @property \Illuminate\Database\Eloquent\Collection detalleVenta
 * @property \Illuminate\Database\Eloquent\Collection devolucionDetalles
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection pagos
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property integer idproducto
 * @property string precio_venta
 * @property string precio_anterior
 */
class EstadisticaPrecio extends Model
{
    use SoftDeletes;

    public $table = 'estadistica_precio';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'idproducto',
        'marca_id',
        'categoria_id',
        'precio_venta',
        'precio_anterior',
        'fecha_hora'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idproducto' => 'integer',
        'marca_id' => 'integer',
        'categoria_id' => 'integer',
        'precio_venta' => 'string',
        'precio_anterior' => 'string',
        'fecha_hora' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class);
    }
     public function marca()
    {
        return $this->belongsTo(\App\Models\Marca::class);
    }
     public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }
}
