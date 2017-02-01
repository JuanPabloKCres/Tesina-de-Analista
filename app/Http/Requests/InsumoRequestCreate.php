<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsumoRequestCreate extends Request
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
            'nombre'=> 'required|max:50|unique:insumos',
            'unidad_medida_id' =>'required',
            'stock'=>'required',
            'stockMinimo'=>'required',
            'costo'=>'required',
            //'color_id' => 'required',         no es obligatorio
            //'tipo_id' => 'required',
            //'talle_id'=> 'required',          no es obligatorio
            'material_id'=> 'required'
        ];
    }
}
