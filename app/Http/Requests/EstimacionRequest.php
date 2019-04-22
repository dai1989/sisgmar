<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'idproducto' => 'required',
          'cantidad' => 'required',
          'precio_venta' => 'required',
          'descuento' => 'required',
          'total_venta' =>'required'
        ];
    }
}
