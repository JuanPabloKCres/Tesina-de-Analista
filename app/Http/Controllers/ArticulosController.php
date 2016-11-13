<?php

namespace App\Http\Controllers;

use App\Articulo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticuloRequestCreate;
use App\Http\Requests\ArticuloRequestEdit;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Route;

class ArticulosController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Esp el manejador de fechas de Laravel
    }

    /*
    * 	Si la solicitud fue realizada utilizando ajax se busca y se devuelve nombre del articulo solicitado;
    * sino se devuelve la vista con los registros.
    */
    public function index(Request $request)
    {
        if($request->ajax()){
           $articulo = Articulo::find($request->id);
           $datosValidados = array("nombreArticulo"=>$articulo->nombre, "stockSuficiente"=>$articulo->stockSuficiente($request->cantidadSolicitada));
           return response()->json(json_encode($datosValidados, true));
        }
        $articulos = Articulo::all();
        if ($articulos->count() == 0) { // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.articulos.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.articulos.tabla')->with('articulos', $articulos);
        }
    }


    public function create()
    {
    }


    public function store(Request $request)
    {
        $articulo = new Articulo($request->all()); // Guardamos los valores cargados en la vista en una variable de tipo marca.
        $articulo->save(); //se almacena en la base de datos.

        Flash::success('El articulo "'. $articulo->nombre.'"" ha sido registrada de forma existosa.');
        return redirect()->route('admin.articulos.index');
    }


    public function show($id)
    {
        $articulo = Articulo::find($id);
        return view('admin.articulos.show')->with('articulo', $articulo);
    }


    public function update(Request $request, $id)
    {
        $articulo = Articulo::find($id);
        $articulo->fill($request->all());
        $articulo->save();
        Flash::success("Se ha realizado la actualización del registro: ".$articulo->nombre.".");
        return redirect()->route('admin.articulos.show', $id);
    }


    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        Flash::error("Se ha eliminado el articulo ".$articulo->nombre.".");
        return redirect()->route('admin.articulos.index');
    }
}
