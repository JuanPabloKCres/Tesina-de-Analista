<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\TipoPublicado;

class TipoComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tipos = TipoPublicado::orderBy('nombre','ASC')->searchActivos()->lists('nombre','id');
        $view->with('tipos', json_decode($tipos, true));
    }

}