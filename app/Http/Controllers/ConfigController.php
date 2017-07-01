<?php

namespace App\Http\Controllers;

use App\Auditoria;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Config;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests\ConfiguracionRequest;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    public function show($id)
    {
        $config = Config::find($id);
        return view('admin.configuracion.show')->with('configuracion',$config);
    }


    function update(ConfiguracionRequest $request, $id)
    {
        $config = Config::find($id);
        $dato_anterior = "nombre: ".$config->nombre." || Permitir pago con Cheque a CF: ".$config->pago_cheque_cf." || Permitir ventas s/ stock: ".$config->ventas_sin_stock." || Editar precio de venta: ".$config->ingresar_precio_venta." || imagen:".$config->imagen;
        if ($request->file('imagen'))
        {
            $file = $request->file('imagen');        
            $nombreImagen = 'configuraciones_' . time() . '.' . $file->getClientOriginalExtension();            
            if (Storage::disk('configuraciones')->exists($config->imagen))
             {
                Storage::disk('configuraciones')->delete($config->imagen);   // Borramos la imagen anterior.      
             }
            $config->fill($request->all());
            $config->imagen = $nombreImagen;  // Actualizamos el nombre de la nueva imagen.
            Storage::disk('configuraciones')->put($nombreImagen, \File::get($file));  // Movemos la imagen nueva al directorio /imagenes/usuarios   
            $config->save();

            Flash::success("Se ha realizado la actualización del registro de configuración del sistema");
            return redirect()->route('admin.configuraciones.show', $id);            
        }

        /** Auditoria cambio de estado */
        $auditoria = new Auditoria();
        $auditoria->tabla = "config";
        $auditoria->elemento_id = $config->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->dato_nuevo = "nombre: ".$config->nombre." || Permitir pago con Cheque a CF: ".$config->pago_cheque_cf." || Permitir ventas s/ stock: ".$config->ventas_sin_stock." || Editar precio de venta: ".$config->ingresar_precio_venta." || imagen:".$config->imagen;
        $auditoria->save();
        /**Fin Auditoria **/
        $config->fill($request->all());
        $config->pago_cheque_cf = $request->permitir_cheque_cf;
        $config->ventas_sin_stock = $request->ventas_sin_stock;
        $config->ingresar_precio_venta = $request->permitir_ingresar_precio;
        $config->save();
        Flash::success("Se ha realizado la actualización del registro de configuración del sistema");
        return redirect()->route('admin.configuraciones.show', $id);
    }

}
