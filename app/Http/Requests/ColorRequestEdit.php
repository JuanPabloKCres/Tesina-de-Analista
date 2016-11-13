<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ColorRequestEdit extends Request
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
            'nombre' => 'required|max:50|unique:colores,nombre,'.$this->route->getParameter('colores'),
        ];
    }
}
