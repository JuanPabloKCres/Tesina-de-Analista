<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Insumo;

class InsumosComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $insumos = Insumo::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('insumos', json_decode($insumos, true));
    }
}
