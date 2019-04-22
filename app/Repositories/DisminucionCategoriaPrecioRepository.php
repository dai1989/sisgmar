<?php

namespace App\Repositories;

use App\Models\DisminucionCategoriaPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DisminucionCategoriaPrecioRepository
 * @package App\Repositories
 * @version March 14, 2019, 3:15 am -03
 *
 * @method DisminucionCategoriaPrecio findWithoutFail($id, $columns = ['*'])
 * @method DisminucionCategoriaPrecio find($id, $columns = ['*'])
 * @method DisminucionCategoriaPrecio first($columns = ['*'])
*/
class DisminucionCategoriaPrecioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idproducto',
        'user_id',
        'categoria_id',
        'fecha_hora',
        'disminucion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DisminucionCategoriaPrecio::class;
    }
}
