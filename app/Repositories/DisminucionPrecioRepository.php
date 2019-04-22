<?php

namespace App\Repositories;

use App\Models\DisminucionPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DisminucionPrecioRepository
 * @package App\Repositories
 * @version March 12, 2019, 5:48 pm -03
 *
 * @method DisminucionPrecio findWithoutFail($id, $columns = ['*'])
 * @method DisminucionPrecio find($id, $columns = ['*'])
 * @method DisminucionPrecio first($columns = ['*'])
*/
class DisminucionPrecioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idproducto',
        'user_id',
        'fecha_hora',
        'disminucion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DisminucionPrecio::class;
    }
}
