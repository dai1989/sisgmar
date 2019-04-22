<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\DisminucionPrecio;

class UpdateDisminucionPrecioRequest extends FormRequest
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
    public function rules(){
        $id = $this->disminucionPrecio;
        $rules = DisminucionPrecio::$rules;
        //$rules['campo'] = $rules['campo'] . ',campo,' . $id;

        return $rules;
    }
}
