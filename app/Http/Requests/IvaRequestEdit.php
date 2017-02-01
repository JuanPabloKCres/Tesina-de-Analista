<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class IvaRequestEdit extends Request
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
            'iva' => 'required|max:50|unique:ivas,iva,'.$this->route->getParameter('ivas')
        ];
    }
}
