<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Localidad;
use App\Responiva;

class ConfiguracionComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $localidades = Localidad::orderBy('nombre','ASC')->lists('nombre','id');
        $responIva = Responiva::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('localidades', json_decode($localidades, true))
            ->with('responIva', json_decode($responIva, true));
    }

}