<?php

namespace App\Repositories;

use App\Models\PagoProveedor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PagoProveedorRepository
 * @package App\Repositories
 * @version April 12, 2019, 6:47 pm -03
 *
 * @method PagoProveedor findWithoutFail($id, $columns = ['*'])
 * @method PagoProveedor find($id, $columns = ['*'])
 * @method PagoProveedor first($columns = ['*'])
*/
class PagoProveedorRepository extends BaseRepository
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
        return PagoProveedor::class;
    }
}
