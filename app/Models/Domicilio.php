<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Domicilio
 * @package App\Models
 * @version March 20, 2019, 2:50 pm -03
 *
 * @property \App\Models\Localidad localidad
 * @property \App\Models\Persona persona
 * @property \App\Models\Provincia provincia
 * @property \App\Models\TipoDomicilio tipoDomicilio
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
 * @property \Illuminate\Database\Eloquent\Collection pagos
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection permissionUser
 * @property \Illuminate\Database\Eloquent\Collection productos
 * @property \Illuminate\Database\Eloquent\Collection rolUser
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string calle
 * @property string calle_numero
 * @property string descripcion
 * @property integer tipodomicilio_id
 * @property integer localidad_id
 * @property integer provincia_id
 * @property integer persona_id
 */
class Domicilio extends Model
{
    use SoftDeletes;

    public $table = 'domicilios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'calle',
        'calle_numero',
        'descripcion',
        'tipodomicilio_id',
        'localidad_id',
        'provincia_id',
        'persona_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'calle' => 'string',
        'calle_numero' => 'string',
        'descripcion' => 'string',
        'tipodomicilio_id' => 'integer',
        'localidad_id' => 'integer',
        'provincia_id' => 'integer',
        'persona_id' => 'integer'
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
    public function localidad()
    {
        return $this->belongsTo(\App\Models\Localidad::class);
    }

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
    public function provincia()
    {
        return $this->belongsTo(\App\Models\Provincia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipodomicilio()
    {
        return $this->belongsTo(\App\Models\TipoDomicilio::class);
    }
}
