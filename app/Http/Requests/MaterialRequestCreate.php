<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MaterialRequestCreate extends Request
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


    public function rules()
    {
        return [
            'nombre' => 'required|max:50|unique:materiales',
            'descripcion' => 'max:50'
        ];
    }
}
