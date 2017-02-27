<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rol;
use App\User;
use App\Auditoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\Http\Requests\RolRequestCreate;
use App\Http\Requests\RolRequestEdit;
use Illuminate\Http\Request;


class RolesController extends Controller
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
        $roles = Rol::all();
        if ($roles->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.roles.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.roles.tabla')->with('roles',$roles); // se devuelven los registros
        }
    }


    public function create(Request $request)
    {
        if($request->ajax()){

            $modulos = "";
            $rol = new Rol();
            if($request->usuarios_roles === 'true'){
                $modulos = 'Usuarios_Roles |';
            }
            if($request->parametros === 'true') {
                $modulos = $modulos." ".'Parametros |';
            }
            if($request->insumos_compras === 'true'){
                $modulos = $modulos." ".'Insumos_Compras |';
            }
            if($request->articulos === 'true') {
                $modulos = $modulos." ".'Articulos |';
            }
            if($request->proveedores_rubros === 'true') {
                $modulos = $modulos." ".'Proveedores_Rubros |';
            }
            if($request->clientes === 'true') {
                $modulos = $modulos." ".'Clientes |';
            }
            if($request->ventas === 'true') {
                $modulos = $modulos." ".'Ventas |';
            }
            if($request->cajas === 'true') {
                $modulos = $modulos." ".'Cajas |';
            }
            if($request->auditorias === 'true') {
                $modulos = $modulos." ".'Auditorias |';
            }
            if($request->adminweb === 'true') {
                $modulos = $modulos." ".'AdminWeb |';
            }
            $rol->nombre = $request->nombre;
            $rol->modulos = $modulos;
            $rol->save();

            /** Auditoria almacena creacion */

            $auditoria = new Auditoria();
            $auditoria->tabla = "roles";
            $auditoria->elemento_id = $rol->id;
            $autor = new Auth();
            $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
            $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
            $auditoria->accion = "alta";
            $auditoria->dato_nuevo = "nombre: ".$rol->nombre." modulos: ".$rol->modulos;
            $auditoria->dato_anterior = null;
            $auditoria->save();
            return redirect()->route('admin.roles.index');
        }
        return redirect()->route('admin.roles.index');
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $rol = Rol::find($id);
        return view('admin.roles.show')->with('rol',$rol);
    }


    public function update(RolRequestEdit $request, $id)
    {
        $rol = Rol::find($id);
        $dato_anterior = $rol->nombre;        //obtenemos el 'nombre' del registro antes de sobreescribirlo
        $rol->fill($request->all());
        $rol->save();
        Flash::success("Se ha realizado la actualización del registro: ".$rol->nombre.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "roles";
        $auditoria->elemento_id = $rol->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo = "nombre: ".$rol->nombre;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.roles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        $dato_anterior =  "nombre: ".$rol->nombre." modulos: ".$rol->modulos;

        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "roles";
        $auditoria->elemento_id = $rol->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";

        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $rol->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$rol->nombre.".");
        return redirect()->route('admin.roles.index');
    }
}
