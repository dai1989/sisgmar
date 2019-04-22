<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Proveedor
 * @package App\Models
 * @version January 18, 2019, 12:48 am CST
 *
 * @property \Illuminate\Database\Eloquent\Collection ContactoProveedore
 * @property \Illuminate\Database\Eloquent\Collection contactos
 * @property \Illuminate\Database\Eloquent\Collection detalleEstimacion
 * @property \Illuminate\Database\Eloquent\Collection detalleIngreso
 * @property \Illuminate\Database\Eloquent\Collection detallePresupuesto
 * @property \Illuminate\Database\Eloquent\Collection detalleVenta
 * @property \Illuminate\Database\Eloquent\Collection Ingreso
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection presupuesto
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \Illuminate\Database\Eloquent\Collection venta
 * @property string razonsocial
 * @property string cuit
 */
class Proveedor extends Model
{
    use SoftDeletes;

    public $table = 'proveedores';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'razonsocial',
        'cuit',
        'condicion_iva'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'razonsocial' => 'string',
        'cuit' => 'string',
        'condicion_iva' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contactoproveedor()
    {
        return $this->hasMany(\App\Models\ContactoProveedor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ingreso()
    {
        return $this->hasMany(\App\Models\Ingreso::class);
    }
}
