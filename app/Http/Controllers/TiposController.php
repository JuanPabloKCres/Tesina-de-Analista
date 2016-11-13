<?php

namespace App\Http\Controllers;

use App\Tipo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoRequestCreate;
use App\Http\Requests\TipoRequestEdit;

class TiposController extends Controller
{

    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Espa�ol el manejador de fechas de Laravel
    }

    public function index()
    {
        $tipos = Tipo::all();
        if ($tipos->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.tipoArticulos.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.tipoArticulos.tabla')->with('tipos',$tipos); // se devuelven los registros
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.parametros.tipoArticulos.create');
    }

    public function store(TipoRequestCreate $request)
    {
        $tipo = new Tipo($request->all());
        $tipo->save();
        Flash::success('El tipo de articulo "'. $tipo->nombre.'" ha sido registrado de forma existosa.');
        return redirect()->route('admin.tipoArticulos.index');
    }


    public function show($id)
    {
        $tipo= Tipo::find($id);
        return view('admin.parametros.tipoArticulos.show')->with('tipo',$tipo);
    }

    public function update(Request $request, $id)
    {
        $tipo = Tipo::find($id);
        $tipo->fill($request->all());
        $tipo->save();
        Flash::success("Se ha realizado la actualización del registro: ".$tipo->nombre.".");
        return redirect()->route('admin.tipoArticulos.show', $id);
    }

    public function destroy($id)
    {
        $tipo = Tipo::find($id);
        $tipo->delete();
        Flash::error("Se ha eliminado el talle: ".$tipo->nombre.".");
        return redirect()->route('admin.tipoArticulos.index');
    }
}
