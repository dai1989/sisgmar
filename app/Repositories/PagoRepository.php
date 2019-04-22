<?php

namespace App\Repositories;

use App\Models\Pago;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PagoRepository
 * @package App\Repositories
 * @version April 12, 2019, 7:13 pm -03
 *
 * @method Pago findWithoutFail($id, $columns = ['*'])
 * @method Pago find($id, $columns = ['*'])
 * @method Pago first($columns = ['*'])
*/
class PagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha_hora',
        'proveedor_id',
        'medio_pago',
        'num_cheque',
        'monto_pedido',
        'fecha_cobro',
        'estado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pago::class;
    }
}
