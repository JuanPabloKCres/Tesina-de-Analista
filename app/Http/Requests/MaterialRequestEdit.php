<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class MaterialRequestEdit extends Request
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
            'nombre' => 'required|max:50|unique:materiales,nombre,'.$this->route->getParameter('materiales'),
            'descripcion'
        ];
    }
}
