<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contacto
 * @package App\Models
 * @version March 20, 2019, 2:18 pm -03
 *
 * @property \App\Models\Persona persona
 * @property \App\Models\TipoContacto tipoContacto
 * @property \Illuminate\Database\Eloquent\Collection aumentoproductoPrecio
 * @property \Illuminate\Database\Eloquent\Collection contactoProveedores
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
 * @property string contac_descripcion
 * @property integer persona_id
 * @property integer tipocontacto_id
 */
class Contacto extends Model
{
    use SoftDeletes;

    public $table = 'contactos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'contac_descripcion',
        'persona_id',
        'tipocontacto_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contac_descripcion' => 'string',
        'persona_id' => 'integer',
        'tipocontacto_id' => 'integer'
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
    public function persona()
    {
        return $this->belongsTo(\App\Models\Persona::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipocontacto()
    {
        return $this->belongsTo(\App\Models\TipoContacto::class);
    }
}
