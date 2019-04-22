<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Persona
 * @package App\Models
 * @version March 14, 2019, 6:01 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection aumentoproductoPrecio
 * @property \Illuminate\Database\Eloquent\Collection Cliente
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
 * @property \Illuminate\Database\Eloquent\Collection Contacto
 * @property \Illuminate\Database\Eloquent\Collection detalleDevoproductos
 * @property \Illuminate\Database\Eloquent\Collection detalleEstimacion
 * @property \Illuminate\Database\Eloquent\Collection detalleIngreso
 * @property \Illuminate\Database\Eloquent\Collection detalleMensual
 * @property \Illuminate\Database\Eloquent\Collection detallePresupuesto
 * @property \Illuminate\Database\Eloquent\Collection detalleVenta
 * @property \Illuminate\Database\Eloquent\Collection devolucionDetalles
 * @property \Illuminate\Database\Eloquent\Collection Devolucion
 * @property \Illuminate\Database\Eloquent\Collection Domicilio
 * @property \Illuminate\Database\Eloquent\Collection Mensual
 * @property \Illuminate\Database\Eloquent\Collection optionUser
 * @property \Illuminate\Database\Eloquent\Collection pagos
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection Presupuesto
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \Illuminate\Database\Eloquent\Collection Ventum
 * @property string tipo_persona
 * @property string nombre
 * @property string apellido
 * @property integer documento
 * @property date fecha_nacimiento
 * @property string genero
 * @property string tipo_documento
 * @property string condicion_iva
 */
class Persona extends Model
{
    use SoftDeletes;

    public $table = 'personas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_persona',
        'nombre',
        'apellido',
        'documento',
        'fecha_nacimiento',
        'genero',
        'tipo_documento',
        'condicion_iva'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_persona' => 'string',
        'nombre' => 'string',
        'apellido' => 'string',
        'documento' => 'integer',
        'fecha_nacimiento' => 'date',
        'genero' => 'string',
        'tipo_documento' => 'string',
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
    public function cliente()
    {
        return $this->hasMany(\App\Models\Cliente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contacto()
    {
        return $this->hasMany(\App\Models\Contacto::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function devolucion()
    {
        return $this->hasMany(\App\Models\Devolucion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function domicilio()
    {
        return $this->hasMany(\App\Models\Domicilio::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function mensual()
    {
        return $this->hasMany(\App\Models\Mensual::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function presupuesto()
    {
        return $this->hasMany(\App\Models\Presupuesto::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function venta()
    {
        return $this->hasMany(\App\Models\Ventum::class);
    }
}
