<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Iva;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests\IvaRequestCreate;
use App\Http\Requests\IvaRequestEdit;
use Illuminate\Http\Request;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class IvasController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }

    public function index(Request $request)
    {
        $ivas = Iva::all();
        if ($ivas->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.ivas.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.ivas.tabla')->with('ivas',$ivas); // se devuelven los registros
        }
    }

    public function create()
    {
        return view('admin.parametros.ivas.create');
    }

    public function store(IvaRequestCreate $request)
    {
        $iva = new Iva($request->all());
        $iva->save();
        Flash::success('El IVA a"'. $iva->iva.'%" ha sido registrado de forma existosa.');

        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "ivas";
        $auditoria->elemento_id = $iva->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "iva: ".$iva->iva."%";
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.ivas.index');
    }

    public function show($id)
    {
        $iva = Iva::find($id);
        return view('admin.parametros.ivas.show')->with('iva',$iva);
    }

    public function update(IvaRequestEdit $request, $id)
    {
        $iva = Iva::find($id);
        $dato_anterior = "iva: ".$iva->iva."%";
        $iva->fill($request->all());
        $iva->save();
        Flash::success("Se ha realizado la actualización del registro: ".$iva->iva.".");

        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "ivas";
        $auditoria->elemento_id = $iva->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo =  "iva: ".$iva->iva."%";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.ivas.show', $id);
    }

    public function destroy($id)
    {
        $iva = Iva::find($id);
        $dato_anterior =  "iva: ".$iva->iva."%";
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "ivas";
        $auditoria->elemento_id = $iva->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $iva->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$iva->iva."%");
        return redirect()->route('admin.ivas.index');
    }
}
