<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResponivaRequestCreate extends Request
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
            'nombre' => 'required|max:30|unique:responiva',
            'iva'=>'required|max:5',
            'factura'=>'required|max:1',
        ];
    }
}
