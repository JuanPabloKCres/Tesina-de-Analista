<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Auditoria;
use App\InsumoArticulo;
use App\Insumo;
use App\Unidad_Medida;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticuloRequestCreate;
use App\Http\Requests\ArticuloRequestEdit;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Route;

class ArticulosController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Esp el manejador de fechas de Laravel
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Articulos')->where('id', $rol_id)->count() != 0){
            #PASA#
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');

        }
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
                $aceptarPedido = false;
                $id = $request->id;
                $insumosArticulo= InsumoArticulo::where('articulo_id', $id)->get();          //devuelve los insumos_articulo vinculados a un Articulo
                foreach($insumosArticulo as $ia){
                    $cantidadNecesaria = ($ia->cantidad)*($request->cantidadArticuloSolicitado);
                    $insumo = Insumo::find($ia->insumo_id);
                    $stockDisponible = $insumo->stock;
                    if($stockDisponible < $cantidadNecesaria){
                        $aceptarPedido = false;
                        $faltante = $cantidadNecesaria - $stockDisponible;
                        //no se tiene suficiente insumo para aceptar el pedido
                        $respuesta = array("mensaje"=>'No hay stock suficiente para cubrir el pedido (faltan ', "faltante"=>$faltante, "permitir"=>false, "insumo"=>$insumo->nombre, "unidad"=>$insumo->unidad_medida->unidad);
                        return response()->json(json_encode($respuesta, true));
                    }
                    else{
                        //se deberia aceptar el articulo
                        $aceptarPedido = true;
                    }
                }
                if($aceptarPedido == true){
                    $respuesta = array("mensaje"=>'se acepta el insumo', "permitir"=>true);
                    return response()->json(json_encode($respuesta, true));
                }else{
                    return response()->json(json_encode($respuesta, true));
                }
            }
            elseif($request->informarStockRestante){             //bandera antes de consultar
                $id = $request->id;
                $insumosArticulo= InsumoArticulo::where('articulo_id', $id)->get();          //devuelve los insumos_articulo vinculados a un Articulo
                foreach($insumosArticulo as $ia){
                    $insumo = Insumo::find($ia->insumo_id);
                    $stockDisponible = $insumo->stock;
                    $unidad = Unidad_Medida::find($insumo->unidad_medida_id);
                    $respuesta[] = array("insumo"=>$insumo->nombre, "minimo"=>$insumo->stockMinimo, "cantidad_actual"=>$stockDisponible, "unidad"=>$unidad->unidad, "cantidad_insumo"=>$ia->cantidad);
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
        $ventas = Venta::all();
        if ($articulos->count() == 0) { // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.articulos.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.articulos.tabla')->with('articulos', $articulos, 'ventas', $ventas);
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
            /** Primero se instancia y se persiste un articulo */
            $articulo = new Articulo();
            $articulo->nombre = $request->nombre;   #ok
            $articulo->alto = $request->alto;       #ok
            $articulo->ancho = $request->ancho;     #ok
            $articulo->tipo_id = $request->tipo_id;     #ok
            $articulo->talle_id = $request->talle_id;   #ok
            $articulo->color_id = $request->color_id;   #ok
            $articulo->costo = $request->costoArticulo;     #ok
            $articulo->margen = $request->margen;           #ok
            $articulo->ganancia = $request->gananciaArticulo;       #ok
            $articulo->precioVta = $request->precioVta;             #ok
            $articulo->estado = 'se fabrica';
            $articulo->descripcion = 'no hay';
            $articulo->cantidad_insumos = 1;
            //
            $articulo->iva_id = $request->iva_id;             #ok
            $articulo->montoIva = $request->montoIva;
            //
            $articulo->user_id = $request->user_id;
            $articulo->save();
            /** Auditoria almacena creacion */
            $auditoria = new Auditoria();
            $auditoria->tabla = "articulos";
            $auditoria->elemento_id = $articulo->id;
            $autor = new Auth();
            $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
            $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
            $auditoria->accion = "alta";
            $auditoria->dato_anterior = null;
            $auditoria->dato_nuevo = "nombre: ".$articulo->nombre." || alto: ".$articulo->alto." || ancho: ".$articulo->ancho." || tipo_id:".$articulo->tipo_id." ".$articulo->talle_id." || color_id: ".$articulo->color_id." || costo:".$articulo->costo." || margen:".$articulo->margen." || ganancia:".$articulo->ganancia." || precioVta:".$articulo->precioVta." || estado:".$articulo->estado;
            $auditoria->save();

            /** Se recoge en una variable el array de renglones y se crea y persiste el registro de insumos
            Se recorre el array creando a su paso objetos "InsumoArticulo" a partir de los json que se hallan en
             * el array y se persisten*/
            $arrayRenglones = $request->renglones;
            foreach($arrayRenglones as $clave) {    //InsumoArticulo
                $renglon = new InsumoArticulo();
                $renglon->cantidad = $clave['cantidad'];
                $renglon->importe_insumo = $clave['importe'];
                $renglon->precio_unitario = $clave['costo_unitario'];
                $renglon->insumo_id = $clave['insumo_id'];
                $renglon->articulo_id = $articulo->id;
                $renglon->save();
            }
            //Flash::success('El articulo "'. $articulo->nombre.'"" ha sido registrada de forma existosa.');
            //return redirect()->route('admin.articulos.index');
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
        $dato_anterior = "nombre: ".$articulo->nombre." || alto: ".$articulo->alo." || ancho: ".$articulo->ancho." || tipo_id:".$articulo->tipo_id." ".$articulo->talle_id." || color_id: ".$articulo->color_id." || costo:".$articulo->costo." || margen:".$articulo->margen." || ganancia:".$articulo->ganancia." || precioVta:".$articulo->precioVta." || estado:".$articulo->estado;
        $articulo->delete();
        /** Auditoria cambio de estado */
        $auditoria = new Auditoria();
        $auditoria->tabla = "articulos";
        $auditoria->elemento_id = $articulo->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        Flash::error("Se ha eliminado el articulo ".$articulo->nombre.".");
        return redirect()->route('admin.articulos.index');
    }

    /** Cambiar estado del Proveedor (de activo a inactivo) */
    public function edit($id)
    {
        $articulo = Articulo::find($id);
        $articulo->estado = 'no se fabrica';
        $articulo->save();
        $dato_anterior = "nombre: ".$articulo->nombre." || alto: ".$articulo->alo." || ancho: ".$articulo->ancho." || tipo_id:".$articulo->tipo_id." ".$articulo->talle_id." || color_id: ".$articulo->color_id." || costo:".$articulo->costo." || margen:".$articulo->margen." || ganancia:".$articulo->ganancia." || precioVta:".$articulo->precioVta." || estado:".$articulo->estado;
        /** Auditoria cambio de estado */
        $auditoria = new Auditoria();
        $auditoria->tabla = "articulos";
        $auditoria->elemento_id = $articulo->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        Flash::error("Se cambio el estado del articulo ".$articulo->nombre." a 'inactivo'.");
        return redirect()->route('admin.articulos.index');
    }
}
