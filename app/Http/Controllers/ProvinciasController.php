<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Provincia;
use App\Localidad;
use App\Pais;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Http\Requests\ProvinciaRequestCreate;
use App\Http\Requests\ProvinciaRequestEdit;

class ProvinciasController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //si la peticion se realiza por ajax, quiere decir que estamos en vista clientes.createForm intentando encontrar localidades desde provincia en un select.
        if($request->ajax()){
            $localidadesDeProvincia = Localidad::localidades($request->id);
            return response()->json($localidadesDeProvincia);
        }
        $provincias = Provincia::all();
        $paises = Pais::all()->lists('nombre','id');
        if ($provincias->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.provincias.sinRegistros')->with('paises', $paises); //se devuelve la vista para crear un registro
        } else {
            return view('admin.provincias.tabla')->with('provincias', $provincias)->with('paises', $paises); // se devuelven los registros
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('admin.provincias.create');
    }



    public function store(ProvinciaRequestCreate $request)
    {   
        $provincia = new Provincia($request->all());
        $provincia->save();
        Flash::success('La provincia "'. $provincia->nombre.'" ha sido registrada de forma existosa.');
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "provincias";
        $auditoria->elemento_id = $provincia->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$provincia->nombre."|| pais_id: ".$provincia->pais_id;
        $auditoria->dato_anterior = null;
        $auditoria->save();
        return redirect()->route('admin.provincias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paises = Pais::all()->lists('nombre','id'); 
        $provincia = Provincia::find($id);    
        return view('admin.provincias.show')
            ->with('provincia', $provincia)
            ->with('paises', $paises);
    }


    public function update(ProvinciaRequestEdit $request, $id)
    {
        $provincia = Provincia::find($id);
        $dato_anterior = "nombre: ".$provincia->nombre."|| pais_id: ".$provincia->pais_id;        //obtenemos el 'nombre' del registro antes de sobreescribirlo
        $provincia->fill($request->all());
        $provincia->save();

        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "provincias";
        $auditoria->elemento_id = $provincia->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo = "nombre: ".$provincia->nombre."|| pais_id: ".$provincia->pais_id;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();

        Flash::success("Se ha realizado la actualización del registro: ".$provincia->nombre.".");
        return redirect()->route('admin.provincias.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provincia = Provincia::find($id);
        $dato_anterior ="nombre: ".$provincia->nombre." || pais_id: ".$provincia->pais_id;

        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "provincias";
        $auditoria->elemento_id = $provincia->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";

        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();

        $provincia->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$provincia->nombre.".");
        return redirect()->route('admin.provincias.index');
    }

    /** Esta funcion llama al metodo del modelo que obtiene las localidades ingresando id Provincia */
    public function getLocalidades(Request $request, $id){
        if($request->ajax()){
            $localidadesDeProvincia = Localidad::localidades($id);
            return response()->json($localidadesDeProvincia);
        }
    }
}
