<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class frontHomeController extends Controller
{

    public function index()
    {
        return view('front.partes.index');
    }



    public function mantenimiento()
    {
        Flash::overlay('Bien! su mensaje se envio correctamente');
        return Redirect::to('/');
    }


}
