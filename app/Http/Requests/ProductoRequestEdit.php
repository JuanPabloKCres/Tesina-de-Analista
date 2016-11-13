<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class ProductoRequestEdit extends Request
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
            'nombre' => 'required|max:100|unique:productos_publicados,nombre,'.$this->route->getParameter('productos_publicados'),
            'tipo_publicado_id' => 'required',
            'descripcion' => 'max:1000',      
            'imagen' => 'image|mimes:jpeg,png|max:3072'
        ];
    }
}
