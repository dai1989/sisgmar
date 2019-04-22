<?php

namespace App\Repositories;

use App\Models\DisminucionMarcaPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DisminucionMarcaPrecioRepository
 * @package App\Repositories
 * @version March 14, 2019, 3:16 am -03
 *
 * @method DisminucionMarcaPrecio findWithoutFail($id, $columns = ['*'])
 * @method DisminucionMarcaPrecio find($id, $columns = ['*'])
 * @method DisminucionMarcaPrecio first($columns = ['*'])
*/
class DisminucionMarcaPrecioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idproducto',
        'user_id',
        'marca_id',
        'fecha_hora',
        'disminucion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DisminucionMarcaPrecio::class;
    }
}
