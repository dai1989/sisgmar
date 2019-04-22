<?php

namespace App\Repositories;

use App\Models\Autorizacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AutorizacionRepository
 * @package App\Repositories
 * @version January 31, 2019, 1:13 am -03
 *
 * @method Autorizacion findWithoutFail($id, $columns = ['*'])
 * @method Autorizacion find($id, $columns = ['*'])
 * @method Autorizacion first($columns = ['*'])
*/
class AutorizacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'fecha_alta',
        'idcliente',
        'condicion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Autorizacion::class;
    }
}
