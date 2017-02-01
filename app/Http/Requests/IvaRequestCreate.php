<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class IvaRequestCreate extends Request
{
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
            'iva' => 'required|max:3|unique:ivas'
        ];
    }
}
