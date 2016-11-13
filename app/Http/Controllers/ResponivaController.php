<?php

namespace App\Http\Controllers;

use App\Responiva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class ResponivaController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }


    public function index()
    {
        $responiva = Responiva::all();
        if ($responiva->count()==0){
            return view('admin.parametros.responiva.sinRegistros');
        }
        return view('admin.parametros.responiva.tabla')->with('responiva',$responiva);
    }


    public function create()
    {
        return view('admin.parametros.responiva.create');
    }


    public function store(Request $request)
    {
        $responiva = new Responiva($request->all());
        $responiva->save();
        Flash::success('Se ha registrado la responsabilidad tributaria.');
        return redirect()->route('admin.responiva.index');


    }


    public function show($id)
    {
        $responiva = Responiva::find($id);
        return view ('admin.parametros.responiva.show')->with('responiva',$responiva);
    }



    public function update(Request $request, $id)
    {
        $responiva = Responiva::find($id);
        $responiva->fill($request->all());
        $responiva->save();
        Flash::success("Se han actualizado los datos hacerca de la responsabilidad ante IVA: ".$responiva->nombre.".");
        return redirect()->route('admin.responiva.show', $id);
    }


    public function destroy($id)
    {
        $responiva= Responiva::find($id);
        $responiva->delete();
        Flash::error("Se ha suprmido ".$responiva->nombre ." como tipo de responsabilidad ante IVA");
          return redirect()->route('admin.responiva.index');
    }
}
