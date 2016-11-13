<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProveedorRequestCreate extends Request
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
            'nombre' => 'required|max:100|unique:proveedores',
            'cuit' => 'required|max:11|unique:proveedores',
            'celular' => 'max:30',
            'telefono' => 'max:30',

            'localidad_id' => 'required',
            'calle' => 'max:30',
            'altura' => 'max:7',
            'rubro_id' => 'required',
            'email' => 'email|max:100',  
            'web'  => 'max:40',                             //el tipo es 'active_url', despues lo cambio porque me tiraba error
            'imagen' => 'image|mimes:jpeg,png|max:3072',
            'horario_atencion' => 'max:30',
        ];
    }
}
