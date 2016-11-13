<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pais;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests\PaisRequestCreate;
use App\Http\Requests\PaisRequestEdit;
use Illuminate\Http\Request;


class PaisesController extends Controller
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
        $paises = Pais::all();
        if ($paises->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.paises.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.paises.tabla')->with('paises',$paises); // se devuelven los registros
        }
    }


    public function create()
    {
        return view('admin.paises.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaisRequestCreate $request)
    {
        $pais = new Pais($request->all());
        $pais->save();
        Flash::success('El país "'. $pais->nombre.'" ha sido registrado de forma existosa.');
        return redirect()->route('admin.paises.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pais = Pais::find($id);
        return view('admin.paises.show')->with('pais',$pais);
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
    public function update(PaisRequestEdit $request, $id)
    {
        $pais = Pais::find($id);
        $pais->fill($request->all());
        $pais->save();
        Flash::success("Se ha realizado la actualización del registro: ".$pais->nombre.".");
        return redirect()->route('admin.paises.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pais = Pais::find($id);
        $pais->delete();
        Flash::error("Se ha realizado la eliminación del registro: ".$pais->nombre.".");
        return redirect()->route('admin.paises.index');
    }
}
