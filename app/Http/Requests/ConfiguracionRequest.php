<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConfiguracionRequest extends Request
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
            'nombre' => 'required|max:100',
            'telefono' => 'max:30',
            'direccion' => 'required|max:50',
            'localidad_id' => 'required',
            'responiva_id' => 'required',
            'email' => 'email|max:100',
            'cuit'  => 'required|max:11|min:11',
            'imagen' => 'mimes:jpeg,png|max:3072' 
        ];
    }
}
