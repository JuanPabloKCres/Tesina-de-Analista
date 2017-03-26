<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Color;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests\ColorRequestCreate;
use App\Http\Requests\ColorRequestEdit;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class ColoresController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
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
        $colores = Color::all();
        if ($colores->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.colores.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.colores.tabla')->with('colores',$colores); // se devuelven los registros
        }
    }

    public function create()
    {
        return view('admin.parametros.colores.create');
    }


    public function store(Request $request)
    {
        $color = new Color($request->all());
        $color->save();
        Flash::success('El color '.$color->nombre.' se ha registrado satisfactoriamente');

        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "colores";
        $auditoria->elemento_id = $color->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$color->nombre." || codigo: ".$color->codigo;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.colores.index');
    }


    public function show($id)
    {
        $color = Color::find($id);
        return view('admin.parametros.colores.show')->with('color',$color);
    }


    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        $dato_anterior = "nombre: ".$color->nombre." || codigo: ".$color->codigo;
        $color->fill($request->all());
        $color->save();

        Flash::success("Se ha editado el nombre del color");

        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "colores";
        $auditoria->elemento_id = $color->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo = "nombre: ".$color->nombre." || codigo: ".$color->codigo;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.colores.show',$id);
    }


    public function destroy($id)
    {
        $color = Color::find($id);
        $dato_anterior = "nombre: ".$color->nombre." || codigo: ".$color->codigo;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "colores";
        $auditoria->elemento_id = $color->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();

        $color->delete();
        Flash::error("Se ha eliminado el color: ".$color->nombre."de los registros.");
        return redirect()->route('admin.colores.index');

    }
}
