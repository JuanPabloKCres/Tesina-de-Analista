<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\InsumoArticulo;
use App\Insumo;
use App\Unidad_Medida;
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
        if ($request->ajax()){
            if($request->encontrarPrecio){
                $articulo = Articulo::find($request->id);
                $precio = $articulo->precioVta;
                return response()->json(json_encode($precio, true));
            }
            elseif($request->comprobarSiHayInsumosSuficientes){             //bandera antes de consultar
                $id = $request->id;
                $insumosArticulo= InsumoArticulo::where('articulo_id', $id)->get();          //devuelve los insumos_articulo vinculados a un Articulo
                foreach($insumosArticulo as $ia){
                    $cantidadNecesaria = ($ia->cantidad)*($request->cantidadArticuloSolicitado);
                    $insumo = Insumo::find($ia->insumo_id);
                    $stockDisponible = $insumo->stock;
                    if($stockDisponible < $cantidadNecesaria){
                        $faltante = $cantidadNecesaria - $stockDisponible;
                        //no se tiene suficiente insumo para aceptar el pedido
                        $respuesta = array("mensaje"=>'No hay stock suficiente para cubrir el pedido (faltan ', "faltante"=>$faltante, "permitir"=>false, "insumo"=>$insumo->nombre);
                        return response()->json(json_encode($respuesta, true));
                    }
                    else{
                        //se deberia aceptar el articulo
                        $respuesta = array("mensaje"=>'se acepta el insumo', "permitir"=>true);
                        return response()->json(json_encode($respuesta, true));
                    }
                }

                //$datos = array("insumo_id" => $insumosArticulo->insumo_id, "cantidad" => $insumosArticulo->cantidad);
                //return response()->json(json_encode($datos, true));
            }
            elseif($request->informarStockRestante){             //bandera antes de consultar
                $id = $request->id;
                $insumosArticulo= InsumoArticulo::where('articulo_id', $id)->get();          //devuelve los insumos_articulo vinculados a un Articulo
                foreach($insumosArticulo as $ia){
                    $insumo = Insumo::find($ia->insumo_id);
                    $stockDisponible = $insumo->stock;
                    $unidad = Unidad_Medida::find($insumo->unidad_medida_id);
                    $respuesta[] = array("insumo"=>$insumo->nombre, "minimo"=>$insumo->stockMinimo, "cantidad_actual"=>$stockDisponible, "unidad"=>$unidad->unidad);
                }
                return response()->json(json_encode($respuesta, true));
            }
            else{
                $articulo = Articulo::find($request->id);
                $datosValidados = array("nombreArticulo" => $articulo->nombre, "stockSuficiente" => $articulo->stockSuficiente($request->cantidadSolicitada));
                return response()->json(json_encode($datosValidados, true));
            }
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
        Flash::success('El articulo "' . $articulo->nombre . '"" ha sido registrada de forma existosa.');
        return redirect()->route('admin.articulos.index');
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            //$fecha = \Carbon\Carbon::now('America/Buenos_Aires');
            // $fillable = ['nombre','alto','ancho', 'tipo_id', 'talle_id', 'color_id' , 'cantidad_insumos', 'costo', 'margen','ganancia','iva','montoIva', 'precioVta','descripcion', 'estado', 'user_id'];
            /** Primero se instancia y se persiste un articulo */
            $articulo = new Articulo();
            $articulo->nombre = $request->nombre;
            $articulo->alto = $request->alto;
            $articulo->ancho = $request->ancho;
            $articulo->tipo_id = $request->tipo_id;
            $articulo->talle_id = 0;
            $articulo->color_id = $request->color_id;
            $articulo->costo = $request->costoArticulo;
            $articulo->margen = $request->margen;
            $articulo->ganancia = $request->gananciaArticulo;
            $articulo->precioVta = $request->precioVta;
            $articulo->estado = 'se fabrica';
            $articulo->descripcion = 'no hay';
            $articulo->cantidad_insumos = 1;
            //
            $articulo->iva = $request->iva;
            $articulo->montoIva = $request->montoIva;
            //
            $articulo->user_id = 1;
            $articulo->save();

            /** Se recoge en una variable el array de renglones y se crea y persiste el registro de insumos
            Se recorre el array creando a su paso objetos "InsumoArticulo" a partir de los json que se hallan en
             * el array y se persisten*/
            $arrayRenglones = $request->renglones;
            //return response()->json(json_encode($arrayRenglones, true));
            foreach($arrayRenglones as $clave) {    //InsumoArticulo
                $renglon = new InsumoArticulo();
                $renglon->cantidad = $clave['cantidad'];
                $renglon->importe_insumo = $clave['importe'];
                $renglon->precio_unitario = $clave['costo_unitario'];
                $renglon->insumo_id = $clave['insumo_id'];
                $renglon->articulo_id = $articulo->id;
                $renglon->save();
            }

            //return response()->json("¡La compra fue registrada con éxito!");
            Flash::success('El articulo "'. $articulo->nombre.'"" ha sido registrada de forma existosa.');
            return redirect()->route('admin.articulos.index');
        }
        return view('admin.articulos.create');
    }

    public function show($id)
    {
        $articulo = Articulo::find($id);
        return view('admin.articulos.show')->with('articulo', $articulo);
    }

    public function pantalla()
    {
        return view('admin.articulos.create');
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
