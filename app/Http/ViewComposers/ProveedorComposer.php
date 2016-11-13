<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Localidad;
use App\Rubro;
use App\Proveedor;

class ProveedorComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $proveedoreslista = Proveedor::orderBy('nombre','ASC')->lists('nombre','nombre');
        $localidades = Localidad::orderBy('nombre','ASC')->lists('nombre','id');
        $rubros = Rubro::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('rubros', json_decode($rubros, true))
             ->with('proveedoreslista', json_decode($proveedoreslista, true))
             ->with('localidades', json_decode($localidades, true));
    }
}
