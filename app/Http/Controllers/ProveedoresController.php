<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proveedor;
use App\Rubro;
use Laracasts\Flash\Flash;
use App\Http\Requests\ProveedorRequestCreate;
use App\Http\Requests\ProveedorRequestEdit;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class ProveedoresController extends Controller
{
    public function __construct()
    {
    	Carbon::setlocale('es'); 	// Instancio en Español el manejador de fechas de Laravel
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Proveedores_Rubros')->where('id', $rol_id)->count() != 0){
            #PASA#
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');

        }
    }

    public function index(Request $request) /*index similar a Empresa en LaAutentica*/
    {
        $proveedores = Proveedor::all();
        if ($proveedores->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.proveedores.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
          $proveedores = Proveedor::searchNombres($request->nombre)
          ->searchOrigen($request->idorigen)
          ->searchRubro($request->idrubro)
          ->orderBy('id','ASC')
          ->paginate();
          if($request->ajax()){ 	//Si la solicitud fue realizada utilizando ajax se devuelven los registros únicamente a la tabla.
              return response()->json(view('admin.proveedores.tablaLogos',compact('proveedores'))->render());
          }
          return view('admin.proveedores.index')->with('proveedores',$proveedores);
        }
    }

    public function store(ProveedorRequestCreate $request)
    {
        $proveedor = new Proveedor($request->all());
        //Manipulación de Imágenes...
        $nombreImagen = 'sin imagen';
        if ($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $nombreImagen = 'GN_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('proveedores')->put($nombreImagen, \File::get($file));
        }
        $proveedor->imagen = $nombreImagen;
        $proveedor->save();
        Flash::success('El proveedor "'. $proveedor->nombre.'" ha sido registrado de forma exitosa.');
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "proveedores";
        $auditoria->elemento_id = $proveedor->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$proveedor->nombre." || cuit: ".$proveedor->cuit." || localidad_id: ".$proveedor->localidad_id." || direccion:".$proveedor->calle." ".$proveedor->altura." || horario de atencion: ".$proveedor->hora_a_manana." a ".$proveedor->hora_c_mañana." y de ".$proveedor->hora_a_tarde." a ".$proveedor->hora_c_tarde." || teléfono:".$proveedor->telefono." || celular:".$proveedor->celular." || web:".$proveedor->web." || rubro_id:".$proveedor->rubro_id." || imagen:".$proveedor->imagen;
        $auditoria->save();
        return redirect()->route('admin.proveedores.index');
    }

    public function show($id)
    {
        //return view('admin.proveedores.show')->with('proveedor', $this->proveedor);
    	$proveedor = Proveedor::find($id);
        return view('admin.proveedores.show')->with('proveedor', $proveedor);
    }

    public function update(ProveedorRequestEdit $request, $id)
    {
    	$proveedor = Proveedor::find($id);
        $dato_anterior = "nombre: ".$proveedor->nombre." || estado: ".$proveedor->estado." || cuit: ".$proveedor->cuit." || localidad_id: ".$proveedor->localidad_id." || direccion:".$proveedor->calle." ".$proveedor->altura." || horario de atencion: ".$proveedor->hora_a_manana." a ".$proveedor->hora_c_mañana." y de ".$proveedor->hora_a_tarde." a ".$proveedor->hora_c_tarde." || teléfono:".$proveedor->telefono." || celular:".$proveedor->celular." || web:".$proveedor->web." || rubro_id:".$proveedor->rubro_id." || imagen:".$proveedor->imagen;
        if ($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $nombreImagen = 'GN_' . time() . '.' . $file->getClientOriginalExtension();
            if (Storage::disk('proveedores')->exists($proveedor->imagen))
             {
                Storage::disk('proveedores')->delete($proveedor->imagen);   // Borramos la imagen anterior.
             }
            $proveedor->fill($request->all());
            $proveedor->imagen= $nombreImagen;          //Actualizamos el nombre de la nueva imagen.
            Storage::disk('proveedores')->put($nombreImagen, \File::get($file));  // Movemos la imagen nueva al directorio /imagenes/proveedores
            $proveedor->save();
            Flash::success("Se ha realizado la actualización del proveedor: ".$proveedor->name.".");
            /** Auditoria actualizacion */
            $auditoria = new Auditoria();
            $auditoria->tabla = "proveedores";
            $auditoria->elemento_id = $proveedor->id;
            $autor = new Auth();
            $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
            $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
            $auditoria->accion = "modificacion";
            $auditoria->dato_nuevo = "nombre: ".$proveedor->nombre." || cuit: ".$proveedor->cuit." || localidad_id: ".$proveedor->localidad_id." || direccion:".$proveedor->calle." ".$proveedor->altura." || horario de atencion: ".$proveedor->hora_a_manana." a ".$proveedor->hora_c_mañana." y de ".$proveedor->hora_a_tarde." a ".$proveedor->hora_c_tarde." || teléfono:".$proveedor->telefono." || celular:".$proveedor->celular." || web:".$proveedor->web." || rubro_id:".$proveedor->rubro_id." || imagen:".$proveedor->imagen;
            $auditoria->dato_anterior = $dato_anterior;
            $auditoria->save();
            return redirect()->route('admin.proveedores.show', $id);
        }
        $proveedor->fill($request->all());
        $proveedor->save();
        Flash::success("Se ha realizado la actualización del registro: ".$proveedor->nombre.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "proveedores";
        $auditoria->elemento_id = $proveedor->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo = "nombre: ".$proveedor->nombre." || cuit: ".$proveedor->cuit." || localidad_id: ".$proveedor->localidad_id." || direccion:".$proveedor->calle." ".$proveedor->altura." || horario de atencion: ".$proveedor->hora_a_manana." a ".$proveedor->hora_c_mañana." y de ".$proveedor->hora_a_tarde." a ".$proveedor->hora_c_tarde." || teléfono:".$proveedor->telefono." || celular:".$proveedor->celular." || web:".$proveedor->web." || rubro_id:".$proveedor->rubro_id." || imagen:".$proveedor->imagen;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.proveedores.show', $id);
    }

    public function destroy($id)
    {
    	$proveedor = Proveedor::find($id);
        $dato_anterior = "nombre: ".$proveedor->nombre." || cuit: ".$proveedor->cuit." || localidad_id: ".$proveedor->localidad_id." || direccion:".$proveedor->calle." ".$proveedor->altura." || horario de atencion: ".$proveedor->hora_a_manana." a ".$proveedor->hora_c_mañana." y de ".$proveedor->hora_a_tarde." a ".$proveedor->hora_c_tarde." || teléfono:".$proveedor->telefono." || celular:".$proveedor->celular." || web:".$proveedor->web." || rubro_id:".$proveedor->rubro_id." || imagen:".$proveedor->imagen;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "proveedores";
        $auditoria->elemento_id = $proveedor->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        Storage::disk('proveedores')->delete($proveedor->imagen); // Borramos la imagen asociada.
        $proveedor->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$proveedor->nombre.".");
        return redirect()->route('admin.proveedores.index');
    }

    /** Cambiar estado del Proveedor (de activo a inactivo) */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->estado = 'inactivo';
        $proveedor->save();
        $dato_anterior = "nombre: ".$proveedor->nombre." || estado: ".$proveedor->estado." || cuit: ".$proveedor->cuit." || localidad_id: ".$proveedor->localidad_id." || direccion:".$proveedor->calle." ".$proveedor->altura." || horario de atencion: ".$proveedor->hora_a_manana." a ".$proveedor->hora_c_mañana." y de ".$proveedor->hora_a_tarde." a ".$proveedor->hora_c_tarde." || teléfono:".$proveedor->telefono." || celular:".$proveedor->celular." || web:".$proveedor->web." || rubro_id:".$proveedor->rubro_id." || imagen:".$proveedor->imagen;
        /** Auditoria cambio de estado */
        $auditoria = new Auditoria();
        $auditoria->tabla = "proveedores";
        $auditoria->elemento_id = $proveedor->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        Flash::error("Se cambio el estado del proveedor ".$proveedor->nombre." a 'inactivo'.");
        return redirect()->route('admin.proveedores.index');
    }
}
