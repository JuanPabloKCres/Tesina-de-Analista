<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\ProductoPublicado;

class ProductoFrontIndexComposer {

    public function compose(View $view)
    {
        $productos = ProductoPublicado::searchActivos()
        ->orderBy('nombre','ASC')
        ->paginate(6);
        $view->with('productos', $productos);
    }

}