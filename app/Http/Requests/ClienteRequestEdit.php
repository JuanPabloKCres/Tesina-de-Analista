<?php

namespace App\Http\Requests;

use Illuminate\Routing\Route;
use App\Http\Requests\Request;

class ClienteRequestEdit extends Request
{
    public function __construct(Route $route)
    {
        $this->route = $route;
    }
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
            'nombre' => 'required|max:50|unique:clientes,nombre,'.$this->route->getParameter('clientes'),
            'apellido' => 'required|max:100|unique:clientes,apellido,'.$this->route->getParameter('clientes'),
            'cuit'=> 'max:11|unique:clientes,cuit,'.$this->route->getParameter('clientes'),
            'dni'=> 'max:8|unique:clientes,dni,'.$this->route->getParameter('clientes'),
            'telefono' => 'required|max:100|unique:clientes,telefono,'.$this->route->getParameter('clientes'),
            'direccion' => 'required|max:100|unique:clientes,direccion,'.$this->route->getParameter('clientes'),
            'localidad_id' => 'required',
            //'responIva_id' => 'required',
            'email' => 'email|max:30',
            'empresa',
            'descripcion'
        ];
    }
}
