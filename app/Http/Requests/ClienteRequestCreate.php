<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClienteRequestCreate extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'responIva_id' => 'required',
            'cuit'=> 'max:11|unique:clientes',
            'dni'=> 'max:8|unique:clientes',
            'email' => 'email|max:100|unique:clientes',
            'telefono' => 'required|max:100|unique:clientes',
            'direccion',
            'provincia_id' => 'required',
            'localidad_id' => 'required',
            'descripcion'
        ];
    }
}
