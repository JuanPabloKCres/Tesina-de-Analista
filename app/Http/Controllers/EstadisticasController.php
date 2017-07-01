<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Venta;
use App\ClienteRanking;
use App\ArticuloRanking;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Illuminate\Routing\Route;

use Illuminate\Support\Collection as Collection;

class EstadisticasController extends Controller
{
    public function __construct() {
        Carbon::setToStringFormat('d/m/Y');
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Ventas')->where('id', $rol_id)->count() != 0){
            #PASA#
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');
        }
    }

     public function index(Request $request)
     {
         $pedidos = Venta::whereNotNull('userVenta_id')
             ->orderBy('id','ASC')
             ->paginate(99999);  /** mandar a la vista estadisticas solo los pedidos entregados (ventas) */
         $fecha1= "";
         $fecha2= "";
         $articulosVendidos = 0;
         $totalRecaudado = 0;
         $rankingClientes = [];
         $rankingArticulos = [];
         $ventas_entre_fechas = [];
         if(!is_null($request->fechaInicio)){
             $fecha1= $request->fechaInicio;
             $fecha2= $request->fechaFin;

             //dd($fecha1, $fecha2);
         }else{
             $fechahoy =  \Carbon\Carbon::now('America/Buenos_Aires');
             $fecha1= $fechahoy->format('d-m-Y');
             $fecha2= $fechahoy->format('d-m-Y');
         }

         /** Empezamos a juntar los datos necesarios para pasar a la vista. */
         foreach ($pedidos as $pedido) {
             $fechaPedido = date_create($pedido->fecha_venta); //la fecha del pedido es tomada y transformada en una variable de date

             if ( ( $fechaPedido >= date_create($fecha1))&&($fechaPedido <= date_create($fecha2))){ //se compara que la fecha del pedido se encuentre entre las fechas que determinan el rango
                 //guardamos la pedido en un listado para pasar a la vista
                 array_push($ventas_entre_fechas, $pedido);
                 //las dos posteriores variables son contadores que se irán incrementando a medida que transcurra el foreach
                 $articulosVendidos =  $articulosVendidos +  $pedido->cantidadArticulos();
                 $totalRecaudado = $totalRecaudado +  $pedido->importe();
                 //comenzamos el tratamiento para el ranking de clientes. Si existe el cliente en la lista solo actualizamos los datos.
                 // Sino creamos una instancia de clienteRanking y lo asociamos al listado.
                 if(array_key_exists($pedido->cliente->id, $rankingClientes)){
                     $clienteRanking = new ClienteRanking();
                     $clienteRanking = $rankingClientes[$pedido->cliente->id];
                     $clienteRanking->cantCompras =   $clienteRanking->cantCompras + 1;
                     $clienteRanking->valorCompras = $clienteRanking->valorCompras + $pedido->importe();
                     $rankingClientes[$pedido->cliente->id] = $clienteRanking;
                 }else{
                     $clienteRanking = new ClienteRanking();
                     $clienteRanking->id = $pedido->cliente->id;
                     $clienteRanking->nombreCompleto = $pedido->cliente->apellido." ".$pedido->cliente->nombre;
                     //$clienteRanking->empresa = $pedido->cliente->empresa;
                     $clienteRanking->cantCompras = 1;
                     $clienteRanking->valorCompras = $pedido->importe();
                     $rankingClientes[$pedido->cliente->id] = $clienteRanking;
                 }
                 //comenzamos el tratamiento para el ranking de artículos. Si existe el artículo en la lista solo actualizamos los datos.
                 // Sino creamos una instancia de articuloRanking y lo asociamos al listado. Este tiene de particular al anterior de que
                 //por cada registro de venta hay que realizar un foreach para conocer los articulos y la información asociada a ellos.
                 foreach ($pedido->articulos_ventas as $articuloPedido) {
                     if(array_key_exists($articuloPedido->articulo->id, $rankingArticulos)){
                         $articuloRanking = new ArticuloRanking();
                         $articuloRanking = $rankingArticulos[$articuloPedido->articulo->id];
                         $articuloRanking->cantidad = $articuloRanking->cantidad + $articuloPedido->cantidad;
                         $articuloRanking->importe = $articuloRanking->importe + $articuloPedido->importe;
                         $rankingArticulos[$articuloPedido->articulo->id] = $articuloRanking;
                     }else{
                         $articuloRanking = new ArticuloRanking();
                         $articuloRanking->id = $articuloPedido->articulo->id;
                         $articuloRanking->nombre = $articuloPedido->articulo->nombre;
                         $articuloRanking->cantidad = $articuloPedido->cantidad;
                         $articuloRanking->importe = $articuloPedido->importe;
                         $rankingArticulos[$articuloPedido->articulo->id] = $articuloRanking;
                     }
                 }
             }
         }
         //ambos listados son convertidos en instancias de collection de laravel para poder ordenarlos
         //y obtener la cantidad de registros de interés.
         $collectionClientes = Collection::make($rankingClientes);
         $collectionArticulos = Collection::make($rankingArticulos);
         //se retornan la vista y los datos asociados a ella.
         return view('admin.estadisticas.tabla')
             ->with('pedidos',$ventas_entre_fechas)
             ->with('totalRecaudado',$totalRecaudado)
             ->with('articulosVendidos',$articulosVendidos)
             ->with('fecha1',$fecha1)
             ->with('fecha2',$fecha2)
             ->with('cantidadClientes',$collectionClientes->count())
             ->with('cantidadArticulos',$collectionArticulos->count())
             ->with('rankingClientes',$collectionClientes->sortByDesc('valorCompras')->take(5))
             ->with('rankingArticulos',$collectionArticulos->sortByDesc('cantidad')->take(5));
     }


}
