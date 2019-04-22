<?php

namespace App\Repositories;

use App\Models\DomicilioProveedor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DomicilioProveedorRepository
 * @package App\Repositories
 * @version March 20, 2019, 3:33 pm -03
 *
 * @method DomicilioProveedor findWithoutFail($id, $columns = ['*'])
 * @method DomicilioProveedor find($id, $columns = ['*'])
 * @method DomicilioProveedor first($columns = ['*'])
*/
class DomicilioProveedorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipodomicilio_id',
        'localidad_id',
        'provincia_id',
        'proveedor_id',
        'calle',
        'calle_numero',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DomicilioProveedor::class;
    }
}
