<?php

namespace App\Http\Controllers;

use App\Comprobante;
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
            $cliente_id = $request->cliente_id;

            $comprobante = new Comprobante();
            $comprobante->user_id = $usuario_id;
            $comprobante->cliente_id = $cliente_id;
            $comprobante->comprobante = "Factura B";
            $comprobante->save();

            $respuesta = array("comprobante_id" => $comprobante->id, "tipo" => $comprobante->comprobante);
            return response()->json(json_encode($respuesta, true));
        }
    }
}
