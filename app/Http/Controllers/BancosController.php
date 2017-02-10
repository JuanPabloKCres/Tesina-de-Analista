<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Banco;
use App\Cheque;
use App\Venta;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests\BancoRequestCreate;
use App\Http\Requests\BancoRequestEdit;
use Illuminate\Http\Request;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;


class BancosController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }

    public function index()
    {
        $bancos = Banco::all();
        if ($bancos->count()==0){       //devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.bancos.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.bancos.tabla')->with('bancos',$bancos);  // se devuelven los registros
        }
    }


    public function create()
    {
        return view('admin.parametros.bancos.create');
    }


    public function store(BancoRequestCreate $request)
    {
        $banco = new Banco($request->all());
        $banco->save();
        Flash::success('El banco "'. $banco->nombre.'" ha sido registrado de forma existosa.');
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "bancos";
        $auditoria->elemento_id = $banco->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$banco->nombre;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.bancos.index');
    }

    public function show($id)
    {
        $banco = Banco::find($id);
        return view('admin.parametros.bancos.show')->with('banco',$banco);
    }


    public function update(BancoRequestEdit $request, $id)
    {
        $banco = Banco::find($id);
        $dato_anterior = "nombre: ".$banco->nombre;
        $banco->fill($request->all());
        $banco->save();
        Flash::success("Se ha realizado la actualización del registro: ".$banco->nombre.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "bancos";
        $auditoria->elemento_id = $banco->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo =  "nombre: ".$banco->nombre;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();

        return redirect()->route('admin.bancos.show', $id);
    }

    public function destroy($id)
    {
        $banco = Banco::find($id);
        $dato_anterior =  "nombre: ".$banco->nombre;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "bancos";
        $auditoria->elemento_id = $banco->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $banco->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$banco->nombre.".");
        return redirect()->route('admin.bancos.index');
    }
}
