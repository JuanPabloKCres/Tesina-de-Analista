<?php

namespace App\Http\Controllers;

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
        $config->fill($request->all());
        $config->save();
        Flash::success("Se ha realizado la actualización del registro de configuración del sistema");
        return redirect()->route('admin.configuraciones.show', $id);
    }

}
