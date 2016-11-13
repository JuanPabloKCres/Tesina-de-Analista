<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\TipoPublicado;

class TipoFrontIndexComposer {      /*Relacionado a la vista del front (nada de Admin)*/


    public function compose(View $view)
    {
        $tipos = TipoPublicado::searchActivos()
            ->orderBy('nombre','ASC')
            ->paginate(6);
        $view->with('tipos', $tipos);
    }
}