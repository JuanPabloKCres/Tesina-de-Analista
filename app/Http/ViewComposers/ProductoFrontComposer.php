<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\TipoPublicado;
use App\ProductoPublicado;

class ProductoFrontComposer {

    public function compose(View $view)
    {
        $productoslista = ProductoPublicado::orderBy('nombre','ASC')->searchActivos()->lists('nombre','nombre');
        $tipos = TipoPublicado::orderBy('nombre','ASC')->searchActivos()->list('nombre','id');

        $view->with('tipos',json_decode($tipos, true))
            ->with('productoslista', json_decode($productoslista, true));
    }

}