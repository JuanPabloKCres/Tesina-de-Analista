<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResponivaRequestEdit extends Request
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
            //'nombre' => 'required|max:50|unique:responiva,nombre,'.$this->route->getParameter('responiva'),
            'iva' => 'required|max:3',
            'factura' => 'max:1',
            'descripcion' => 'max:50',
        ];
    }
}
