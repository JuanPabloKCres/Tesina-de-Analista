<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\TipoPublicado;

class TipoParaFrontComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposlista = TipoPublicado::orderBy('nombre','ASC')->searchActivos()->lists('nombre','nombre');
        $view->with('tiposlista', json_decode($tiposlista, true));
    }
}