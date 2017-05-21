<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Pais;
use App\Provincia;
use App\Localidad;
use App\Cliente;
use App\Responiva;

class ClienteComposer {

    public function compose(View $view)
    {
        $clienteslista = Cliente::orderBy('apellido','ASC')->lists('nombre','apellido','id');
        $clientesApellido = Cliente::orderBy('apellido','ASC')->lists('apellido','id');
        $clientesNombre = Cliente::orderBy('nombre','ASC')->lists('nombre','id');
        $paises = Pais::orderBy('nombre','ASC')->lists('nombre','id');
        $provincias = Provincia::orderBy('nombre','ASC')->lists('nombre','id');
        $localidades = Localidad::orderBy('nombre','ASC')->lists('nombre','id');
        $responIva = Responiva::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('responIva', json_decode($responIva, true))
             ->with('clienteslista', json_decode($clienteslista, true))
             ->with('clientesNombre', json_decode($clientesNombre, true))
             ->with('clientesApellido', json_decode($clientesApellido, true))
             ->with('paises', json_decode($paises, true))
             ->with('provincias', json_decode($provincias, true))
             ->with('localidades', json_decode($localidades, true));
    }

}
