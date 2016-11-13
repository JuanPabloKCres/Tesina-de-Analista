<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductoRequestCreate extends Request
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
            'nombre' => 'required|max:100|unique:productos_publicados',
            'tipo_publicado_id' => 'required',
            'descripcion' => 'max:1000',      
            'imagen' => 'image|mimes:jpeg,png|required|max:3072'
        ];
    }
}
