<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Session;
use Redirect;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades;
use Carbon\Carbon;

class Email_NotificacionesController extends Controller
{
    public function index(Request $request)     /**Para notificacion automatica de stock bajo a administrador**/
    {
        if($request->ajax()){
            if($request->email_info_pedido){
                $cliente = Cliente::find($request->id_cliente);
                $nombre_y_apellido = $cliente->nombre." ".$cliente->apellido;
                Mail::send('emails.datos_pedido', ['cliente'=>$nombre_y_apellido, 'total'=>$request->total, 'fecha_hoy'=>$request->fecha_hoy, 'fecha_entrega'=>$request->fecha_entrega], function($msj){
                    $msj->subject('Información de su pedido');
                    $msj->to('jpcaceres.nea@gmail.com');
                });
                Flash::overlay('Se ha enviado email con la info del pedido');
                return response()->json(json_encode("Se envio el email del pedido, desde MailController.php", true));
            }




            else{
                Mail::send('emails.notificacion', $request->all(), function($msj){
                    $msj->subject('Notificacion de stock bajo');
                    $msj->to('jpaulnava@gmail.com');
                });
                Flash::overlay('Se ha notificado al repositor de la necesidad de reponer insumos');
                return response()->json(json_encode("Se envio el email, desde MailController.php", true));
            }
        }
        return view('emails.datos_pedido');
    }
}
