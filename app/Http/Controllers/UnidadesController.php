<?php

namespace App\Http\Controllers;

use App\Unidad_Medida;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Unidad_MedidaRequestCreate;
use App\Http\Requests\Unidad_MedidaRequestEdit;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class UnidadesController extends Controller
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
        $unidades_medidas = Unidad_Medida::all();
        if ($unidades_medidas->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.unidades_medidas.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.unidades_medidas.tabla')->with('unidades_medidas', $unidades_medidas ); // se devuelven los registros
        }
    }


    public function create()
    {
        return view('admin.parametros.unidades_medidas.create');
    }

    public function store(Unidad_MedidaRequestCreate $request)
    {
        $unidad_medida = new Unidad_Medida($request->all());
        $unidad_medida->save();
        Flash::success('El unidad_medida de articulo "'. $unidad_medida->nombre.'" ha sido registrado de forma existosa.');

        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "unidades_medidas";
        $auditoria->elemento_id = $unidad_medida->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "unidad: ".$unidad_medida->unidad." || detalle: ".$unidad_medida->detalle;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.unidades_medidas.index');
    }


    public function show($id)
    {
        $unidad_medida= Unidad_Medida::find($id);
        return view('admin.parametros.unidades_medidas.show')->with('unidad_medida',$unidad_medida);
    }

    public function update(Request $request, $id)
    {
        $unidad_medida = Unidad_Medida::find($id);
        $dato_anterior = "unidad: ".$unidad_medida->nombre." || detalle: ".$unidad_medida->detalle;
        $unidad_medida->fill($request->all());
        $unidad_medida->save();
        Flash::success("Se ha realizado la actualización del registro: ".$unidad_medida->unidad.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "unidades_medidas";
        $auditoria->elemento_id = $unidad_medida->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo = "unidad: ".$unidad_medida->nombre." || detalle: ".$unidad_medida->detalle;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.unidades_medidas.show', $id);
    }

    public function destroy($id)
    {
        $unidad_medida = Unidad_Medida::find($id);
        $dato_anterior = "unidad: ".$unidad_medida->nombre." || detalle: ".$unidad_medida->detalle;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "unidades_medidas";
        $auditoria->elemento_id = $unidad_medida->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $unidad_medida->delete();
        Flash::error("Se ha eliminado el talle: ".$unidad_medida->nombre.".");
        return redirect()->route('admin.unidades_medidas.index');
    }
}
