<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='personas';

    protected $primaryKey='id';

    protected $fillable=[
        'tipo_persona',
        'nombre',
        'apellido',
        'tipo_documento',
        'documento',
        'fecha_nacimiento',
        'genero'
       
    ];
}