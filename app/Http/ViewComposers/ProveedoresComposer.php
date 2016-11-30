<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Proveedor;

class ProveedoresComposer {
  /**
   * Bind data to the view.
   *
   * @param  View  $view
   * @return void
   */
    public function compose(View $view)
    {
        //$proveedores = Proveedor::all();
        $proveedores = Proveedor::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('proveedores', $proveedores);
    }
}
