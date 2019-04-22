<?php

namespace App\Repositories;

use App\Models\EstadisticaPrecio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EstadisticaPrecioRepository
 * @package App\Repositories
 * @version March 11, 2019, 7:47 pm -03
 *
 * @method EstadisticaPrecio findWithoutFail($id, $columns = ['*'])
 * @method EstadisticaPrecio find($id, $columns = ['*'])
 * @method EstadisticaPrecio first($columns = ['*'])
*/
class EstadisticaPrecioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idproducto',
        'precio_venta',
        'precio_anterior'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EstadisticaPrecio::class;
    }
}
