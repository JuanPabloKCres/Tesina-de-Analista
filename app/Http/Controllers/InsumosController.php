<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use App\Http\Requests\InsumoRequestCreate;
use App\Http\Requests\InsumoRequestEdit;
use App\Insumo;
use App\Tipo;
use App\Talle;
use App\Color;
use App\Unidad_Medida;
use App\Material;
use Laracasts\Flash\Flash;

class InsumosController extends Controller
{

    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Esp el manejador de fechas de Laravel
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            if($request->confeccionArticulos){        //si se llama desde vista Articulos (rellenando insumos para articulo)
                /*
                }*/
                if($request->encontrarUnidad){
                    $insumo = Insumo::find($request->id);
                    $unidad_medida_id = $insumo->unidad_medida_id;
                    $unidad = Unidad_Medida::find($unidad_medida_id);
                    return response()->json(json_encode($unidad, true));
                }
                else{
                    $insumo = Insumo::find($request->id);
                    return response()->json(json_encode($insumo, true));
                }
                Flash::success('El insumo "'. $insumo->nombre.'"" ha sido registrada de forma existosa.');
            }
            if($request->encontrarCosto) {   //pluginsCompras (recupera el costo almacenado, antes de comprar)
                $insumo = Insumo::find($request->id);
                return response()->json(json_encode($insumo, true));
            }
            else{                                       //si se llama desde vista Compra de insumos (rellenando insumos para comprar)
                $insumo = Insumo::find($request->id);
                $datosValidados = array("nombreInsumo"=>$insumo->nombre, "stockSuficiente"=>$insumo->stockSuficiente($request->cantidadSolicitada));
                return response()->json(json_encode($datosValidados, true));
            }
        }
        $insumos = Insumo::all();
        if ($insumos->count() == 0) { // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.insumos.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.insumos.tabla')->with('insumos', $insumos);
        }
    }


    public function store(Request $request)
    {
        $insumo = new Insumo($request->all()); // Guardamos los valores cargados en la vista en una variable de insumo.
        $insumo->save(); //se almacena en la base de datos.

        Flash::success('El insumo "'. $insumo->nombre.'"" ha sido registrada de forma existosa.');
        return redirect()->route('admin.insumos.index');
    }

    public function show($id)
    {
        $insumo = Insumo::find($id);
        return view('admin.insumos.show')->with('insumo', $insumo);
    }

    public function update(Request $request, $id)
    {
        $insumo = Insumo::find($id);
        $insumo->fill($request->all());
        $insumo->save();
        Flash::success("Se ha realizado la actualización del registro: ".$insumo->nombre.".");
        return redirect()->route('admin.insumos.show', $id);
    }


    public function destroy($id)
    {
        $insumo = Insumo::find($id);
        $insumo->delete();
        Flash::error("Se ha eliminado el insumo ".$insumo->nombre.".");
        return redirect()->route('admin.insumos.index');
    }

    public function obtenerCosto(Request $request)
    {
        if($request->ajax()) {
            $insumo = Insumo::find($request->id);
            $costo = $insumo->costo;
            return response()->json(json_encode($costo, true));
        }
    }

}