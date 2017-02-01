<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pais;
use App\Provincia;
use App\Auditoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\Http\Requests\PaisRequestCreate;
use App\Http\Requests\PaisRequestEdit;
use Illuminate\Http\Request;


class PaisesController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //si la peticion se realiza por ajax, quiere decir que estamos en vista clientes.createForm intentando encontrar provincias desde pais en un select.
        if($request->ajax()){
            $provinciasDePais = Provincia::provincias($request->id);
            return response()->json($provinciasDePais);
        }

        $paises = Pais::all();
        if ($paises->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.paises.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.paises.tabla')->with('paises',$paises); // se devuelven los registros
        }
    }


    public function create()
    {
        return view('admin.paises.create');
    }


    public function store(PaisRequestCreate $request)
    {
        $pais = new Pais($request->all());
        $pais->save();
        Flash::success('El país "'. $pais->nombre.'" ha sido registrado de forma existosa.');

        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "paises";
        $auditoria->elemento_id = $pais->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$pais->nombre;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.paises.index');
    }


    public function show($id)
    {
        $pais = Pais::find($id);
        return view('admin.paises.show')->with('pais',$pais);
    }


    public function edit($id)
    {
    }


    public function update(PaisRequestEdit $request, $id)
    {
        $pais = Pais::find($id);
        $dato_anterior = $pais->nombre;        //obtenemos el 'nombre' del registro antes de sobreescribirlo
        $pais->fill($request->all());
        $pais->save();
        Flash::success("Se ha realizado la actualización del registro: ".$pais->nombre.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "paises";
        $auditoria->elemento_id = $pais->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo = "nombre: ".$pais->nombre;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.paises.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pais = Pais::find($id);
        $dato_anterior = $pais->nombre;

        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "paises";
        $auditoria->elemento_id = $pais->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditoria
        $auditoria->accion = "eliminacion";

        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $pais->delete();

        Flash::error("Se ha realizado la eliminación del registro: ".$pais->nombre.".");
        return redirect()->route('admin.paises.index');
    }
}
