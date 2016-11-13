<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CajasRequestCreate extends Request
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
            'hora_apertura' => 'required', 
            'fecha_lote' => 'required',
            'saldo_inicial' => 'required',
            'userApertura_id' => 'required' 
        ];
    }
}
