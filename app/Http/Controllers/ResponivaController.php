<?php

namespace App\Http\Controllers;

use App\Responiva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class ResponivaController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }


    public function index()
    {
        $responiva = Responiva::all();
        if ($responiva->count()==0){
            return view('admin.parametros.responiva.sinRegistros');
        }
        return view('admin.parametros.responiva.tabla')->with('responiva',$responiva);
    }


    public function create()
    {
        return view('admin.parametros.responiva.create');
    }


    public function store(Request $request)
    {
        $responiva = new Responiva($request->all());
        $responiva->save();
        Flash::success('Se ha registrado la responsabilidad tributaria.');
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "responiva";
        $auditoria->elemento_id = $responiva->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$responiva->nombre." || iva: ".$responiva->iva." || Factura: ".$responiva->factura;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.responiva.index');
    }


    public function show($id)
    {
        $responiva = Responiva::find($id);
        return view ('admin.parametros.responiva.show')->with('responiva',$responiva);
    }



    public function update(Request $request, $id)
    {
        $responiva = Responiva::find($id);
        $dato_anterior = "nombre: ".$responiva->nombre." || iva: ".$responiva->iva." || Factura: ".$responiva->factura;
        $responiva->fill($request->all());
        $responiva->save();
        Flash::success("Se han actualizado los datos hacerca de la responsabilidad ante IVA: ".$responiva->nombre.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "responiva";
        $auditoria->elemento_id = $responiva->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo =  "nombre: ".$responiva->nombre." || iva: ".$responiva->iva." || Factura: ".$responiva->factura;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.responiva.show', $id);
    }


    public function destroy($id)
    {
        $responiva= Responiva::find($id);
        $dato_anterior =  "nombre: ".$responiva->nombre." || iva: ".$responiva->iva." || Factura: ".$responiva->factura;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "responiva";
        $auditoria->elemento_id = $responiva->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $responiva->delete();
        Flash::error("Se ha suprmido ".$responiva->nombre ." como tipo de responsabilidad ante IVA");
          return redirect()->route('admin.responiva.index');
    }
}
