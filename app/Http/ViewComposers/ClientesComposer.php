<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Cliente;


class ClientesComposer {
  /**
   * Bind data to the view.
   *
   * @param  View  $view
   * @return void
   */
    public function compose(View $view)
    {
        $clientes = Cliente::all();
        $view->with('clientes', $clientes);
    }
}
