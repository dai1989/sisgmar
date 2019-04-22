<?php

namespace App\Repositories;

use App\Models\AumentoMarcaPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AumentoMarcaPrecioRepository
 * @package App\Repositories
 * @version March 14, 2019, 1:27 am -03
 *
 * @method AumentoMarcaPrecio findWithoutFail($id, $columns = ['*'])
 * @method AumentoMarcaPrecio find($id, $columns = ['*'])
 * @method AumentoMarcaPrecio first($columns = ['*'])
*/
class AumentoMarcaPrecioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idproducto',
        'user_id',
        'marca_id',
        'fecha_hora',
        'aumento'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AumentoMarcaPrecio::class;
    }
}
