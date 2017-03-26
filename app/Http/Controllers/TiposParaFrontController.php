<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TipoPublicado;
use App\ProductoPublicado;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TipoParaFrontRequestCreate;
use App\Http\Requests\TipoParaFrontRequestEdit;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class TiposParaFrontController extends Controller
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

       // $this->beforeFilter('@find',['only'=>['edit', 'show', 'update','destroy']]); // Acá hacemos llamado a la función find para optimizar código y no repetir instrucciones en todos esos métodos.
    }

    public function find (Route $route)
    {
        $this->tipo = TipoPublicado::find($route->getParameter('tipos'));  // tipos es el atributo que figura junto al nombre de la ruta en el archivo de rutas.
    }

    /**
     * Mostrar una lista de los recursos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipos = TipoPublicado::searchNombres($request->nombre)
        ->orderBy('nombre','ASC')
        ->paginate(); 

        //Retorno todos los registros de tipos según las especificaciones dadas a la variable recien creada.
        if($request->ajax()){ //Si la solicitud fue realizada utilizando ajax se devuelven los registros únicamente a la tabla.
            return response()->json(view('admin.publicacionesFront.tipos.tablaLogos',compact('tipos'))->render());
        }
        return view('admin.publicacionesFront.tipos.index')->with('tipos',$tipos); //Retorno al cliente la vista asociada al método con la colección de registros necesesarios.
    }


    public function store(TipoParaFrontRequestCreate $request)
    {
        //Creación de los registro de TipoPublicado.
        $tipo = new TipoPublicado($request->all()); // Guardamos los valores cargados en la vista en una variable de tipo.
        //Manipulación de Imagen...
        $nombreImagen = 'sin imagen';
        if ($request->file('imagen'))  // Compruebo si recibo un archivo de imagen como parámetro.
        {
            $file = $request->file('imagen');        
            $nombreImagen = 'GN_' . time() . '.' . $file->getClientOriginalExtension(); // Le damos un nombre por defecto: la primera parte es laAutentica, después el momento justo de la transacción y por último la extensión de la imagen.
            Storage::disk('tipos')->put($nombreImagen, \File::get($file));
        }

        $tipo->imagen = $nombreImagen;
        $tipo->save();

        //Creación y asociación del registro de Logo con su respectiva Marca.
/*
        $imagen = new Imagen_Tipo();
        $imagen->nombre = $nombreImagen;
        $imagen->tipo()->associate($tipo);
        $imagen->save();
*/

        Flash::success('El tipo "'. $tipo->nombre.'"" ha sido registrado de forma existosa.');
        return redirect()->route('admin.tipos.index');
    }


    public function show($id)
    {
        $tipo = TipoPublicado::find($id);
        return view('admin.publicacionesFront.tipos.show')->with('tipo', $tipo);
    }


    public function update(TipoParaFrontRequestEdit $request, $id)
    {
        $tipo = TipoPublicado::find($id);
        if ($request->file('imagen'))
        {                  
            //$imagen_tipo = $this->tipo->imagen;
            $file = $request->file('imagen');        
            $nombreImagen = 'GN_' . time() . '.' . $file->getClientOriginalExtension();
            if (Storage::disk('tipos')->exists($tipo->imagen))
             {
                Storage::disk('tipos')->delete($tipo->imagen);   // Borramos la imagen anterior.
             }
            $tipo->fill($request->all());
            $tipo->imagen = $nombreImagen;        //Actualizamos el nombre de la nueva imagen.
            Storage::disk('tipos')->put($nombreImagen, \File::get($file));  // Movemos la imagen nueva al directorio /imagenes/tipos
            $tipo->save();
            Flash::success("Se ha realizado la actualización del proveedor: ".$tipo->nombre.".");
            return redirect()->route('admin.tipos.show', $id);

        }

        if ($request->estado == null)
        {
            $this->tipo->estado = 0;
            foreach ($this->tipo->productos as $producto)
            {
                $producto->estado = 0;
                $producto->save();
            }               
        }
        $tipo->fill($request->all());
        $tipo->save();
        Flash::success("Se ha actualizado el registro: ".$this->tipo->nombre.".");
        return redirect()->route('admin.tipos.show', $id);
    }


    public function destroy($id)
    {
        $tipo = TipoPublicado::find($id);
        $imagen = $tipo->imagen;
        if ($imagen != 'sin imagen')
        {            
            Storage::disk('tipos')->delete($imagen); // Borramos la imagen asociada.
        }       
        $tipo->delete(); // Borramos el registro.
        Flash::error("Se ha eliminado el registro: ".$tipo->nombre.".");
        return redirect()->route('admin.tipos.index');
    }
}