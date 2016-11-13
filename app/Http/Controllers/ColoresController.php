<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Color;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

use App\Http\Requests\ColorRequestCreate;
use App\Http\Requests\ColorRequestEdit;

class ColoresController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }


    public function index()
    {
        $colores = Color::all();
        if ($colores->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.parametros.colores.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.parametros.colores.tabla')->with('colores',$colores); // se devuelven los registros
        }
    }

    public function create()
    {
        return view('admin.parametros.colores.create');
    }


    public function store(Request $request)
    {
    //  dd($request);
        $color = new Color($request->all());
        $color->save();

        Flash::success('El color '.$color->nombre.' se ha registrado satisfactoriamente');
        return redirect()->route('admin.colores.index');
    }



    public function show($id)
    {
        $color = Color::find($id);
        return view('admin.parametros.colores.show')->with('color',$color);
    }


    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        $color->fill($request->all());
        $color->save();

        Flash::success("Se ha editado el nombre del color");
        return redirect()->route('admin.colores.show',$id);
    }


    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();

        Flash::error("Se ha eliminado el color: ".$color->nombre."de los registros.");
        return redirect()->route('admin.colores.index');

    }
}
