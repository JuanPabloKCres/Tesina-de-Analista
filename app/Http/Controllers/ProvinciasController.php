<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Provincia;
use App\Pais;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Http\Requests\ProvinciaRequestCreate;
use App\Http\Requests\ProvinciaRequestEdit;

class ProvinciasController extends Controller
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
    public function index()
    {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinciaRequestCreate $request)
    {   
        $provincia = new Provincia($request->all());
        $provincia->save();
        Flash::success('La provincia "'. $provincia->nombre.'" ha sido registrada de forma existosa.');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinciaRequestEdit $request, $id)
    {
        $provincia = Provincia::find($id); 
        $provincia->fill($request->all());
        $provincia->save();
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
        $provincia->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$provincia->nombre.".");
        return redirect()->route('admin.provincias.index');
    }
}
