<?php

namespace App\Http\Controllers;

use App\Material;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequestCreate;
use App\Http\Requests\MaterialRequestEdit;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class MaterialesController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Espa�ol el manejador de fechas de Laravel
    }

    public function index()
    {
        $materiales = Material::all();
        if ($materiales->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.materiales.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.materiales.tabla')->with('materiales',$materiales); // se devuelven los registros
        }
    }


    public function create()
    {
        return view('admin.parametros.materiales.create');
    }

    public function store(MaterialRequestCreate $request)
    {
        $material = new Material($request->all());
        $material->save();
        Flash::success('El material "'. $material->nombre.'" ha sido registrado de forma existosa.');
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "materiales";
        $auditoria->elemento_id = $material->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$material->nombre;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.materiales.index');
    }

    public function show($id)
    {
        $material = Material::find($id);
        return view('admin.parametros.materiales.show')->with('material',$material);
    }

    public function update(MaterialRequestEdit $request, $id)
    {
        $material = Material::find($id);
        $dato_anterior =  "nombre: ".$material->nombre;
        $material->fill($request->all());
        $material->save();
        Flash::success("Se ha modificado el nombre del material");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "materiales";
        $auditoria->elemento_id = $material->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo =  "nombre material: ".$material->nombre;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.materiales.show', $id);
    }


    public function destroy($id)
    {
        $material = Material::find($id);
        $dato_anterior =  "nombre: ".$material->nombre;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "materiales";
        $auditoria->elemento_id = $material->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $material->delete();
        Flash::error("Se ha eliminado el material: ".$material->nombre." de los registros.");
        return redirect()->route('admin.materiales.index');
    }
}
