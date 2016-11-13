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

class ProveedoresController extends Controller
{
    public function __construct()
    {
    	Carbon::setlocale('es'); 	// Instancio en Español el manejador de fechas de Laravel
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
        $nombreImagen = 'sin imagen';                   //esto saque el 28/4 18:00 ***JUAMPY

        if ($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $nombreImagen = 'GN_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('proveedores')->put($nombreImagen, \File::get($file));
        }

        $proveedor->imagen = $nombreImagen;
        $proveedor->save();
        /*
        $imagen = new Logo_Proveedor();
        $imagen->nombre = $nombreImagen;
        $imagen->proveedor()->associate($proveedor);
        $imagen->save();
        */
        Flash::success('El proveedor "'. $proveedor->nombre.'" ha sido registrado de forma exitosa.');
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
            return redirect()->route('admin.proveedores.show', $id);
        }

        $proveedor->fill($request->all());
        $proveedor->save();
        Flash::success("Se ha realizado la actualización del registro: ".$proveedor->nombre.".");
        return redirect()->route('admin.proveedores.show', $id);
    }



    public function destroy($id)
    {
    	$proveedor = Proveedor::find($id);
        Storage::disk('proveedores')->delete($proveedor->imagen); // Borramos la imagen asociada.
        $proveedor->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$proveedor->nombre.".");
        return redirect()->route('admin.proveedores.index');
    }

}
