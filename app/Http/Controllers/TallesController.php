<?php

namespace App\Http\Controllers;

use App\Talle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TalleRequestCreate;
use App\Http\Requests\TalleRequestEdit;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;


class TallesController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Espa�ol el manejador de fechas de Laravel
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Parametros')->where('id', $rol_id)->count() != 0){
            #PASA#
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');

        }
    }

    public function index()
    {
        $talles = Talle::all();
        if ($talles->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.talles.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.talles.tabla')->with('talles',$talles); // se devuelven los registros
        }
    }

    public function create()
    {
        return view('admin.parametros.talles.create');
    }

    public function store(Request $request)
    {
        $talle = new Talle($request->all());
        $talle->save();
        Flash::success('El talle "'. $talle->talle.'" ha sido registrado de forma existosa.');

        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "talles";
        $auditoria->elemento_id = $talle->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "talle: ".$talle->talle;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.talles.index');
    }


    public function show($id)
    {
        $talle= Talle::find($id);
        return view('admin.parametros.talles.show')->with('talle',$talle);
    }

    public function update(Request $request, $id)
    {
        $talle = Talle::find($id);
        $dato_anterior = "talle: ".$talle->talle;
        $talle->fill($request->all());
        $talle->save();
        Flash::success("Se ha realizado la actualización del registro: ".$talle->nombre.".");

        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "talles";
        $auditoria->elemento_id = $talle->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo =  "talle: ".$talle->talle;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();

        return redirect()->route('admin.talles.show', $id);
    }

    public function destroy($id)
    {
        $talle = Talle::find($id);
        $dato_anterior =  "talle: ".$talle->talle;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "talles";
        $auditoria->elemento_id = $talle->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $talle->delete();
        Flash::error("Se ha eliminado el talle: ".$talle->nombre.".");
        return redirect()->route('admin.talles.index');
    }
}
