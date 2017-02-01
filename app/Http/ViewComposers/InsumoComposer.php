<?php
namespace App\Http\ViewComposers;

use App\Material;
use App\Talle;
use App\Tipo;
use App\Color;
use App\Unidad_Medida;
use Illuminate\Contracts\View\View;

class InsumoComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $materiales = Material::orderBy('nombre','ASC')->lists('nombre','id');
        $unidades_medidas = Unidad_Medida::orderBy('unidad','ASC')->lists('unidad','id');
        $talles = Talle::orderBy('talle','ASC')->lists('talle','id');
        $tipos = Tipo::orderBy('nombre','ASC')->lists('nombre','id');
        $colores = Color::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('materiales',json_decode($materiales, true))
             ->with('unidades_medidas', json_decode($unidades_medidas, true))
             ->with('talles',json_decode($talles, true))
             ->with('tipos',json_decode($tipos, true))
             ->with('colores',json_decode($colores, true));
    }

}
