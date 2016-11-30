<?php

namespace App\Http\Controllers;

use App\Articulo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticuloRequestCreate;
use App\Http\Requests\ArticuloRequestEdit;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Route;

class ArticulosController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Esp el manejador de fechas de Laravel
    }

    /*
    * 	Si la solicitud fue realizada utilizando ajax se busca y se devuelve nombre del articulo solicitado;
    * sino se devuelve la vista con los registros.
    */
    public function index(Request $request)
    {
        if($request->ajax()){
           $articulo = Articulo::find($request->id);
           $datosValidados = array("nombreArticulo"=>$articulo->nombre, "stockSuficiente"=>$articulo->stockSuficiente($request->cantidadSolicitada));
           return response()->json(json_encode($datosValidados, true));
        }
        $articulos = Articulo::all();
        if ($articulos->count() == 0) { // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.articulos.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.articulos.tabla')->with('articulos', $articulos);
        }
    }


    public function store(Request $request)
    {
        $articulo = new Articulo($request->all()); // Guardamos los valores cargados en la vista en una variable de tipo marca.
        $articulo->save(); //se almacena en la base de datos.
        Flash::success('El articulo "'. $articulo->nombre.'"" ha sido registrada de forma existosa.');
        return redirect()->route('admin.articulos.index');
    }

    public function create(Request $request){
        if ($request->ajax()) {
            /** Primero se recoge en una variable el array de renglones y se crea y persiste el registro de insumos */
            $arrayRenglones = $request->renglones;
            $arrayArticulo = $request->arrayArticulo;
            $fecha = \Carbon\Carbon::now('America/Buenos_Aires');

            $articulo = new Articulo();
            $articulo->nombre = $arrayArticulo->nombre;
            $articulo->alto = $arrayArticulo->alto;
            $articulo->ancho = $arrayArticulo->ancho;
            $articulo->tipo_id = $arrayArticulo->tipo_id;
            //$articulo->talle_id = $arrayArticulo->talle_id;
            //$articulo->color_id = $arrayArticulo->color_id;
            $articulo->costo = $arrayArticulo->costoArticulo;
            $articulo->margen = $arrayArticulo->margen;
            $articulo->ganancia = $arrayArticulo->gananciaArticulo;
            $articulo->precioVta = $arrayArticulo->precioVta;
            $articulo->estado = "se fabrica";
            $articulo->descripcion = "no se ha añadido una descripción";
            $articulo->save();

            /* Se recorre el array creando a su paso objetos "InsumoArticulo" a partir de los json que se hallan en
             * el array y se persisten. Luego se instancia el insumo en cuestion y se incrementa el stock.
             * */
            foreach($arrayRenglones as $clave) {    //InsumoArticulo
                $renglon = new InsumoArticulo();
                $renglon->cantidad = $clave['cantidad'];
                $renglon->importe_insumo = $clave['importe'];
                $renglon->precio_unitario = $clave['precio_unitario'];
                $renglon->insumo_id = $clave['insumo_id'];
                $renglon->articulo_id = $articulo->id;
                $renglon->save();
            }

            //return response()->json("¡La compra fue registrada con éxito!");
            Flash::success('El articulo "'. $articulo->nombre.'"" ha sido registrada de forma existosa.');
            return redirect()->route('admin.articulos.index');
        }
    }

    public function show($id)
    {
        $articulo = Articulo::find($id);
        return view('admin.articulos.show')->with('articulo', $articulo);
    }


    public function update(Request $request, $id)
    {
        $articulo = Articulo::find($id);
        $articulo->fill($request->all());
        $articulo->save();
        Flash::success("Se ha realizado la actualización del registro: ".$articulo->nombre.".");
        return redirect()->route('admin.articulos.show', $id);
    }


    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->delete();
        Flash::error("Se ha eliminado el articulo ".$articulo->nombre.".");
        return redirect()->route('admin.articulos.index');
    }
}
