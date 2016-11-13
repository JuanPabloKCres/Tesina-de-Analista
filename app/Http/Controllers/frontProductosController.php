<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductoPublicado;
use Illuminate\Routing\Route;

class frontProductosController extends Controller
{

    public function index(Request $request)
    {
        $productos = ProductoPublicado::searchNombres($request->nombre)
            ->searchTipos($request->idtipo)
            ->searchActivos()
            ->orderBy('nombre','ASC')
            ->paginate();

        if($request->ajax()){ //Si la solicitud fue realizada utilizando ajax se devuelven los registros únicamente a la tabla.
            return response()->json(view('front.productos.contenidoTabla',compact('productos'))->render());
        }
        return view('front.productos.index')->with('productos',$productos);
    }


    public function show(Request $request)
    {
        $producto = ProductoPublicado::find($request->id);
        return response()->json(view('front.productos.modalProducto',compact('producto'))->render());
    }

}
