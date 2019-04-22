<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pago
 * @package App\Models
 * @version April 12, 2019, 7:13 pm -03
 *
 * @property \App\Models\Proveedore proveedore
 * @property \Illuminate\Database\Eloquent\Collection aumentoproductoPrecio
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
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property date fecha_hora
 * @property integer proveedor_id
 * @property string medio_pago
 * @property string num_cheque
 * @property string monto_pedido
 * @property date fecha_cobro
 * @property string estado
 */
class Pago extends Model
{
    use SoftDeletes;

    public $table = 'pagos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'fecha_hora',
        'proveedor_id',
        'medio_pago',
        'num_cheque',
        'monto_pedido',
        'fecha_cobro',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha_hora' => 'date',
        'proveedor_id' => 'integer',
        'medio_pago' => 'string',
        'num_cheque' => 'string',
        'monto_pedido' => 'string',
        'fecha_cobro' => 'date',
        'estado' => 'string'
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
    public function proveedor()
    {
        return $this->belongsTo(\App\Models\Proveedor::class);
    }
}
