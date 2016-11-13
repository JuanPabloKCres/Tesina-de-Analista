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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = Config::find($id);
        return view('admin.configuracion.show')->with('configuracion',$config);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfiguracionRequest $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
