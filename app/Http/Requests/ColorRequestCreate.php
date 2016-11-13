<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ColorRequestCreate extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nombre' => 'required|max:30|unique:colores',
        ];
    }
}
