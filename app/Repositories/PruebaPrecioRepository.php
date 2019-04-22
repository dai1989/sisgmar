<?php

namespace App\Repositories;

use App\Models\PruebaPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PruebaPrecioRepository
 * @package App\Repositories
 * @version March 14, 2019, 11:27 am -03
 *
 * @method PruebaPrecio findWithoutFail($id, $columns = ['*'])
 * @method PruebaPrecio find($id, $columns = ['*'])
 * @method PruebaPrecio first($columns = ['*'])
*/
class PruebaPrecioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idproducto',
        'user_id',
        'categoria_id',
        'marca_id',
        'fecha_hora',
        'aumento'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PruebaPrecio::class;
    }
}
