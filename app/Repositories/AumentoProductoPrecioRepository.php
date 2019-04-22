<?php

namespace App\Repositories;

use App\Models\AumentoProductoPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AumentoProductoPrecioRepository
 * @package App\Repositories
 * @version March 14, 2019, 2:11 am -03
 *
 * @method AumentoProductoPrecio findWithoutFail($id, $columns = ['*'])
 * @method AumentoProductoPrecio find($id, $columns = ['*'])
 * @method AumentoProductoPrecio first($columns = ['*'])
*/
class AumentoProductoPrecioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idproducto',
        'user_id',
        'fecha_hora',
        'aumento'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AumentoProductoPrecio::class;
    }
}
