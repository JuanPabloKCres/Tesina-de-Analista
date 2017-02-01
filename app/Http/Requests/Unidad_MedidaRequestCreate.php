<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Unidad_MedidaRequestCreate extends Request
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
            'unidad' => 'required|max:20|unique:unidades_medidas',
            'detalle'
        ];
    }
}
