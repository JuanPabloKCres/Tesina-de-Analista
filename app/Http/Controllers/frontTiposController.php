<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPublicado;
use App\ProductoPublicado;
use App\Http\Requests;

class frontTiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipos = TipoPublicado::searchNombres($request->nombre)
            ->searchEstado($request->estado)
            ->searchActivos()
            ->orderBy('nombre','ASC')
            ->paginate();

        //Retorno todos los registros de tipos según las especificaciones dadas a la variable recien creada.
        if($request->ajax()){ //Si la solicitud fue realizada utilizando ajax se devuelven los registros únicamente a la tabla.
            return response()->json(view('front.tipoProducto.contenidoTabla',compact('tipos'))->render());
        }
        return view('front.tipos.index')->with('tipos',$tipos); //Retorno al cliente la vista asociada al método con la colección de registros necesesarios.

    }


    public function show($id)
    {
        $tipo = TipoPublicado::find($id);
        $productoslista = ProductoPublicado::searchTipos($id)->searchActivos()->orderBy('nombre','ASC')->lists('nombre','nombre');
        $tipos = TipoPublicado::orderBy('nombre','ASC')->lists('nombre','id');
        $productos = ProductoPublicado::searchTipos($id)
            ->searchActivos()
            ->orderBy('nombre','ASC')
            ->paginate();

        return view('front.tipos.showTipo')
            ->with('tipos', json_decode($tipos, true))
            ->with('productoslista', json_decode($productoslista, true))
            ->with('productos',$productos)
            ->with('tipo',$tipo);
    }

}
