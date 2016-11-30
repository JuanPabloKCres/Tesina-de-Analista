<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Provincia;
use App\Localidad;
use App\Cliente;
use App\Responiva;

class ClienteComposer {

    public function compose(View $view)
    {
        $clienteslista = Cliente::orderBy('apellido','ASC')->lists('apellido','apellido');
        $provincias = Provincia::orderBy('nombre','ASC')->lists('nombre','id');
        $localidades = Localidad::orderBy('nombre','ASC')->lists('nombre','id');
        $responIva = Responiva::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('responIva', json_decode($responIva, true))
             ->with('clienteslista', json_decode($clienteslista, true))
             ->with('provincias', json_decode($provincias, true))
             ->with('localidades', json_decode($localidades, true));
    }

}
