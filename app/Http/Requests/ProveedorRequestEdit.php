<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class ProveedorRequestEdit extends Request
{
    public function __construct(Route $route)
    {
        $this->route = $route;
    }


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|max:100|unique:proveedores,nombre,'.$this->route->getParameter('proveedores'),
            'celular' => 'max:30',
            'telefono' => 'max:30',
            'calle' => 'max:30',
            'altura' => 'max:7',
            'localidad_id' => 'required',
            'rubro_id' => 'required',
            'email' => 'email|max:100',
            'web'  => 'max:40',             //el tipo es 'active_url', despues lo cambio porque me tiraba error
            'imagen' => 'image|mimes:jpeg,png|max:3072',
            'horario_atencion' => 'max:30',
        ];
    }
}
