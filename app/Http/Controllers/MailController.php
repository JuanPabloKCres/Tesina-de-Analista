<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Mockery\CountValidator\Exception;
use Session;
use Redirect;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades;

class MailController extends Controller
{
    public function index(Request $request)     /**Para notificacion automatica de stock bajo a administrador**/
    {
        if($request->ajax()){
            if($request->email_info_pedido==true){
                try{
                    Mail::send('emails.infopedido', $request->all(), function($msj){
                        $msj->subject('Información de su pedido');
                        $msj->to('jpnava@gmail.com@gmail.com');
                    });
                    //Flash::overlay('Se ha enviado email con la info del pedido');
                    return response()->json(json_encode("Se envio el email del pedido, desde MailController.php", true));
                    //return view('emails.datos_pedido');
                }catch (Exception $e){
                    $respuesta = array("excepcion"=>$e);
                    return response()->json(json_encode($respuesta, true));
                }
            }
            else{
                Mail::send('emails.notificacion', $request->all(), function($msj){
                    $msj->subject('Notificacion de stock bajo');
                    $msj->to('jpaulnava@gmail.com');
                });
                //Flash::overlay('Se ha notificado al repositor de la necesidad de reponer insumos');
                return response()->json(json_encode("Se envio el email de notificacion de stock bajo desde MailController.php", true));
            }
        }
        //return view('emails.datos_pedido');
    }

    public function store(Request $request)     /**Para email de contacto desde el Front**/
    {
        Mail::send('emails.contact', $request->all(), function($msj){
            $msj->subject('Correo de contacto');
            $msj->to('jpaulnava@gmail.com');
        });

        Flash::overlay('Bien! su mensaje se envio correctamente');

        return Redirect::to('/');
    }
}
