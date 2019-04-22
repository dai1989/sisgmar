<?php

namespace App\Repositories;

use App\Models\Contacto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactoRepository
 * @package App\Repositories
 * @version March 20, 2019, 2:18 pm -03
 *
 * @method Contacto findWithoutFail($id, $columns = ['*'])
 * @method Contacto find($id, $columns = ['*'])
 * @method Contacto first($columns = ['*'])
*/
class ContactoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'contac_descripcion',
        'persona_id',
        'tipocontacto_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Contacto::class;
    }
}
