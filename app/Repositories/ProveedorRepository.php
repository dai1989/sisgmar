<?php

namespace App\Repositories;

use App\Models\Proveedor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProveedorRepository
 * @package App\Repositories
 * @version January 18, 2019, 12:48 am CST
 *
 * @method Proveedor findWithoutFail($id, $columns = ['*'])
 * @method Proveedor find($id, $columns = ['*'])
 * @method Proveedor first($columns = ['*'])
*/
class ProveedorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'razonsocial',
        'cuit',
        'condicion_iva'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Proveedor::class;
    }
}
