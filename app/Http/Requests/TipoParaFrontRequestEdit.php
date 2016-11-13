<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class TipoParaFrontRequestEdit extends Request
{
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

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
            'nombre' => 'required|max:100|unique:tipos_publicados,nombre,'.$this->route->getParameter('tipos_publicados'),
            'imagen' => 'image|mimes:jpeg,png|max:3072',
        ];
    }
}
