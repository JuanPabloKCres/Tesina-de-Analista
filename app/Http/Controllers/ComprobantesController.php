<?php

namespace App\Http\Controllers;

use App\Comprobante;
use App\Proveedor;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class ComprobantesController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es');            // Instancio en Español el manejador de fechas de Laravel
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $usuario_id = $request->usuario_id;
            $usuario = User::find($usuario_id);

            if($request->nota_pedido){
                $cliente_id = $request->cliente_id;
                $comprobante = new Comprobante();
                $comprobante->user_id = $usuario_id;
                $comprobante->cliente_id = $cliente_id;
                $comprobante->comprobante = "Nota de Pedido";
                $comprobante->save();
                $respuesta = array("comprobante_id" => $comprobante->id, "tipo" => $comprobante->comprobante, 'usuario'=>$usuario->name);
                return response()->json(json_encode($respuesta, true));
            }
            if($request->recibo_compra_insumos){
                $proveedor = Proveedor::find($request->proveedor_id);
                $proveedor_email = $proveedor->email;
                $proveedor_telefono = $proveedor->telefono;
                $cliente_id = $request->proveedor_id;
                $comprobante = new Comprobante();
                $comprobante->user_id = $usuario_id;
                $comprobante->cliente_id = $cliente_id;
                $comprobante->comprobante = "Recibo de Compra";
                $comprobante->save();

                $respuesta = array("comprobante_id" => $comprobante->id, "tipo" => $comprobante->comprobante, "proveedor"=>$proveedor->nombre, "proveedor_email"=>$proveedor_email, "proveedor_telefono"=>$proveedor_telefono, 'usuario'=>$usuario->name);
                return response()->json(json_encode($respuesta, true));
            }
        }
    }
}
