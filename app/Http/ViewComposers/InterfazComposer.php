<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Config;


class InterfazComposer {
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $config = Config::find(1); 

        $view->with('config', $config);

    }

}