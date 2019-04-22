<?php

namespace App\Repositories;

use App\Models\AumentoPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AumentoPrecioRepository
 * @package App\Repositories
 * @version March 14, 2019, 1:41 pm -03
 *
 * @method AumentoPrecio findWithoutFail($id, $columns = ['*'])
 * @method AumentoPrecio find($id, $columns = ['*'])
 * @method AumentoPrecio first($columns = ['*'])
*/
class AumentoPrecioRepository extends BaseRepository
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
        return AumentoPrecio::class;
    }
}
