<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Articulo;

class ArticulosComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $articulos = Articulo::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('articulos', json_decode($articulos, true));
    }

}
