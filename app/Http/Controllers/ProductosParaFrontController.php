<?php

namespace App\Http\Controllers;

use App\ProductoPublicado;
use Illuminate\Http\Request;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Http\Requests\ProductoRequestCreate;
use App\Http\Requests\ProductoRequestEdit;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;


class ProductosParaFrontController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('AdminWeb')->where('id', $rol_id)->count() != 0){
            #PASA#
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');

        }
        //$this->beforeFilter('@find',['only'=>['edit', 'show', 'update','destroy']]); // Acá hacemos llamado a la función find para optimizar código y no repetir instrucciones en todos esos métodos.
    }

    public function find (Route $route)
    {
        $this->producto = ProductoPublicado::find($route->getParameter('productos'));  // productos es el atributo que figura junto al nombre de la ruta en el archivo de rutas.
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productos = ProductoPublicado::searchNombres($request->nombre)
        ->searchTipos($request->idtipo)
        ->searchEstado($request->estado)
        ->orderBy('nombre','ASC')
        ->paginate();
    
        if($request->ajax()){ //Si la solicitud fue realizada utilizando ajax se devuelven los registros únicamente a la tabla.
            return response()->json(view('admin.publicacionesFront.productos.tablaLogos',compact('productos'))->render());
        }
        return view('admin.publicacionesFront.productos.index')->with('productos',$productos);
    }


    public function store(ProductoRequestCreate $request)
    {        
        $producto = new ProductoPublicado($request->all());

        //Manipulación de Imágenes...
        $nombreImagen = 'sin imagen';
        if ($request->file('imagen'))
        {
            $file = $request->file('imagen');        
            $nombreImagen = 'GN_Producto_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('productos')->put($nombreImagen, \File::get($file));
        }        

        $producto->imagen = $nombreImagen;
        $producto->save();
        Flash::success('El producto "'. $producto->nombre .'" ha sido registrado de forma existosa.');
        return redirect()->route('admin.productos.index');
    }


    public function show($id)
    {
        $producto = ProductoPublicado::find($id);
        return view('admin.publicacionesFront.productos.show')->with('producto',$producto);
    }


    public function update(ProductoRequestEdit $request, $id)
    {   
        $estadoAnterior = $this->producto->estado;
        if ($request->file('imagen'))
        {                 
            $logo_producto = $this->producto->logo_producto;
            $file = $request->file('imagen');        
            $nombreImagen = 'GN_' . time() . '.' . $file->getClientOriginalExtension();
            if (Storage::disk('productos')->exists($logo_producto->nombre))
             {
                Storage::disk('productos')->delete($logo_producto->nombre);   // Borramos la imagen anterior.      
             }
            $logo_producto->nombre = $nombreImagen;  // Actualizamos el nombre de la nueva imagen.
            $logo_producto->save();           
            Storage::disk('productos')->put($nombreImagen, \File::get($file));  // Movemos la imagen nueva al directorio /imagenes/productos   
        }  
        $this->producto->fill($request->all());

        if ($this->producto->tipo->estado)
        {
            if ($request->estado == null)
            {
                $this->producto->estado = 0;
            } 
        } else 
        {
            $this->producto->estado = $estadoAnterior;
        }
       
        $this->producto->save();     
        Flash::success("Se ha realizado la actualización del registro: ".$this->producto->nombre.".");
        return redirect()->route('admin.productos.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = $this->producto->imagen;
        if ($imagen != 'sin imagen')
        {            
            Storage::disk('productos')->delete(); // Borramos la imagen asociada.
        } 
        $this->producto->delete();        
        Flash::error("Se ha realizado la eliminación del registro: ".$this->producto->nombre.".");        
        return redirect()->route('admin.productos.index');
    }
}
