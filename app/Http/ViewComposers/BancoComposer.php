<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Banco;

class BancoComposer {

    public function compose(View $view)
    {
        $bancos = Banco::orderBy('nombre','ASC')->lists('nombre','id');
        $view->with('bancos', json_decode($bancos, true));
    }

}