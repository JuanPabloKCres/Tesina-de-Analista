<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticuloRequestEdit extends Request
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
            'nombre' => 'required|max:50|unique:articulos,nombre,'.$this->route->getParameter('articulos'),
            'horas_produccion' => 'min:0|numeric',
            'precioVta' => 'min:0|numeric',
            'montoIva' => 'min:0|numeric',
            'ganancia' => 'min:0|numeric',
            'margen' => 'min:0|numeric',
            'costo' => 'min:0|numeric',
        ];
    }
}
