<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Session;
use Redirect;
use Laracasts\Flash\Flash;

class MailController extends Controller
{

    public function store(Request $request)     /**Para email de contacto desde el Front**/
    {
        Mail::send('emails.contact', $request->all(), function($msj){
            $msj->subject('Correo de contacto');
            $msj->to('jpaulnava@gmail.com');
        });

        Flash::overlay('Bien! su mensaje se envio correctamente');

        return Redirect::to('/');
    }

    public function index(Request $request)     /**Para notificacion automatica de stock bajo a administrador**/
    {
        if($request->ajax()){
            Mail::send('emails.notificacion', $request->all(), function($msj){
                $msj->subject('Notificacion de stock bajo');
                $msj->to('jpaulnava@gmail.com');
            });
            Flash::overlay('Se ha notificado al repositor de la necesidad de reponer insumos');
            return response()->json(json_encode("Se envio el email, desde MailController.php", true));
        }

    }

}
