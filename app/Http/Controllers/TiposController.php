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
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

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

    public function create()
    {
        return view('admin.parametros.tipoArticulos.create');
    }

    public function store(TipoRequestCreate $request)
    {
        $tipo = new Tipo($request->all());
        $tipo->save();
        Flash::success('El tipo de articulo "'. $tipo->nombre.'" ha sido registrado de forma existosa.');
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "tipos";
        $auditoria->elemento_id = $tipo->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$tipo->nombre." || descripcion: ".$tipo->descripcion;
        $auditoria->dato_anterior = null;
        $auditoria->save();
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
        $dato_anterior = "nombre: ".$tipo->nombre." || descripcion: ".$tipo->descripcion;
        $tipo->fill($request->all());
        $tipo->save();
        Flash::success("Se ha realizado la actualización del registro: ".$tipo->nombre.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "tipos";
        $auditoria->elemento_id = $tipo->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo =  "nombre: ".$tipo->nombre." || descripcion: ".$tipo->descripcion;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.tipoArticulos.show', $id);
    }

    public function destroy($id)
    {
        $tipo = Tipo::find($id);
        $dato_anterior =  "nombre: ".$tipo->nombre." || descripcion: ".$tipo->descripcion;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "tipos";
        $auditoria->elemento_id = $tipo->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();

        $tipo->delete();
        Flash::error("Se ha eliminado el talle: ".$tipo->nombre.".");
        return redirect()->route('admin.tipoArticulos.index');
    }
}
