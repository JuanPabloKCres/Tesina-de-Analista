<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\TipoPublicado;
use App\ProductoPublicado;

class ProductoComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $productoslista = ProductoPublicado::orderBy('nombre','ASC')->lists('nombre','nombre');
        $tipos = TipoPublicado::orderBy('nombre','ASC')->lists('nombre','id');

        $view->with('tipos',json_decode($tipos, true))
            ->with('productoslista', json_decode($productoslista, true));
    }

}