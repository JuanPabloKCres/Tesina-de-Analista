<?php

namespace App\Http\Controllers;

use App\Cheque;
use App\InsumoArticulo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Venta;
use App\Caja;
use App\Movimiento;
use App\Articulo;
use App\ArticuloVenta;
use App\Insumo;
use Laracasts\Flash\Flash;
use App\Http\Requests\VentaRequestCreate;
use App\Http\Requests\VentaRequestEdit;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class PedidosController extends Controller {

    public function __construct() {
        Carbon::setlocale('es'); //
    }

    public function index() {
        $pedidos = Venta::searchEntregado(0)
                ->orderBy('id', 'ASC')
                ->paginate();
        return view('admin.pedidos.tablaPedidos')->with('pedidos', $pedidos);
    }

    public function create(Request $request) {
        $caja = Caja::where('cerrado', false)->first(); //Aca se busca el primer registro de caja que este activo (supuestamente debería ser el único, igual se pone asi para que no siga buscando al pedo)
        if ($caja === null) { //al llegar aca preguta si enncontro algo(si $caja no es un objeto vacio o null)
            return view('admin.cajas.create'); //se devuelve la vista para abrir una caja
        } else {
            /*
             * Si la solicitud se realiza a través de ajax quiere decir que que se quiere persistir un nuevo pedido.
             * En caso contrario se devuelve la pantalla para realizar un pedido.
             */
            if ($request->ajax()) {
                /** Primero se recoge en una variable el array de renglones y se crea y se persiste el
                 * registro de pedido/venta.*/
                $arrayRenglones = $request->renglones;
                $fecha = \Carbon\Carbon::now('America/Buenos_Aires');
                $venta = new Venta();
                $movimiento = new Movimiento();
                $venta->fecha_pedido = $fecha->format('d-m-Y');
                $venta->hora_pedido = $fecha->format('H:i');
                $venta->fecha_entrega_estimada = $request->fecha_entrega_estimada;
                $venta->senado = $request->sena;
                $venta->userPedido_id = $request->usuarioPedido;
                $venta->cliente_id = $request->cliente;

                $conceptoMovimiento = "";
                if ($request->pagado == "true") {
                    $venta->pagado = 1;
                }
                if ($request->entregado == "true") {
                    $venta->entregado = 1;
                }

                //////////////////////// CHEQUE //////////////////////
                if ($request->pagoCheque == "true") {
                    $forma_pago = "cheque totalidad";

                    $cheque = new Cheque();
                    $cheque->nro_serie = $request->nro_serie;     #OK
                    $cheque->monto = $request->sena;                        #OK
                    $cheque->banco_id = $request->banco;          #OK
                    $cheque->sucursal = $request->sucursal_banco;         #OK
                    $cheque->cliente_id = $request->cliente;              #OK
                    $cheque->fecha_emision = $request->fecha_emision;     #OK
                    $cheque->fecha_cobro = $request->fecha_cobro;         #OK
                    $cheque->save();                                      #OK

                    $venta->cheque_id = 2;    //se asocia la venta con el cheque nuevo cargado.
                }else{
                    $forma_pago = "efectivo";
                }
                $venta->forma_pago = $forma_pago;
                ////////////////////////////////////////////////////////

                if (($request->pagado == "true") && ($request->entregado == "true")) {
                    $venta->userVenta_id = $request->usuarioPedido;
                    $venta->fecha_venta = $fecha->format('d-m-Y');
                    $venta->hora_venta = $fecha->format('H:i');
                    $conceptoMovimiento = "Venta de artículos por un monto de $" . $venta->senado;
                } else {
                    $conceptoMovimiento = "Seña de un pedido por un monto de $" . $venta->senado;
                }
                $venta->save();     //no esta guardando cuando es venta!!!!!!!!!!!!!!

                /** Se recorre el array creando a su paso objetos "ArticuloVenta" a partir de los json que se hallan en
                 * el array y se persisten. Luego se instancia el articulo en cuestion y se descuenta el stock.
                 * Esto tengo que ver alguna forma mejor porque es medio paraguay se me hace, ba creo XD...
                 */
                foreach ($arrayRenglones as $clave) {
                    $renglon = new ArticuloVenta();
                    $renglon->cantidad = $clave['cantidad'];
                    $renglon->importe = $clave['importe'];
                    $renglon->precio_unitario = $clave['precio_unitario'];
                    $renglon->articulo_id = $clave['articulo_id'];
                    $renglon->venta_id = $venta->id;
                    $renglon->save();
                    //$articulo = Articulo::find($clave['articulo_id']);  //consigo el articulo para recorrer y descontar sus insumos asociados
                    //zona de conflicto!
                    $insumosArticulos = InsumoArticulo::where('articulo_id', $clave['articulo_id'])->get();
                    //return response()->json(json_encode($insumosArticulos, true));
                    foreach ($insumosArticulos as $insumoArticulo) {
                        $insumo = Insumo::find($insumoArticulo->insumo_id);
                        $cantidad_necesaria_x_articulo = $insumoArticulo->cantidad;
                        $cantidad_a_descontar = ($clave['cantidad'] * $cantidad_necesaria_x_articulo);  #OK
                        $insumo->descontarStock($cantidad_a_descontar);                                 #OK (el metodo funciona)
                        $insumo->save();                                                                #OK
                    }
                }
                /*
                 * En este sector se completan los campos y se registra el movimiento en la caja.
                 */
                if ($venta->senado > 0) {
                    $movimiento->caja_id = $caja->id;
                    $movimiento->tipo = 'entrada';
                    $movimiento->monto = $venta->senado;
                    $movimiento->venta_id = $venta->id;
                    $movimiento->user_id = $request->usuarioPedido;
                    $movimiento->hora = $fecha->format('H:i');
                    $movimiento->fecha = $fecha->format('d-m-Y');
                    $movimiento->concepto = $conceptoMovimiento;
                    $movimiento->save();
                }
                /*
                 * Una vez completado el proceso se procede con redireccionar a la pantalla de pedidos.
                 */
                if (($request->pagado == "true") && ($request->entregado == "true")) {
                    return response()->json("¡La venta fue registrada con éxito!");
                } else {
                    return response()->json("¡El pedido fue registrado con éxito!");
                }
            }
            return view('admin.pedidos.createPedido'); // se devuelve la caja en cuestion.
        }
    }



    public function store(Request $request) {
        return response()->json("Exito PRUEBA!");
    }

    public function edit($id) {
        $pedido = Venta::find($id);
        return view('admin.pedidos.showPedido')->with('pedido', $pedido);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $pedido = Venta::find($id);
        $fecha = \Carbon\Carbon::now('America/Buenos_Aires');
        if ($request->pagado) {
            $caja = Caja::where('cerrado', false)->first(); //Aca se busca el primer registro de caja que este activo (supuestamente debería ser el único, igual se pone asi para que no siga buscando al pedo)
            if ($caja === null) { //al llegar aca preguta si enncontro algo(si $caja no es un objeto vacio o null)
                return view('admin.cajas.create'); //se devuelve la vista para abrir una caja
            } else {
                $restoPago = $pedido->importe() - $pedido->senado;
                $pedido->pagado = 1;
                $movimiento = new Movimiento();
                $movimiento->concepto = "Se termino de pagar un pedido por el monto de: $" . $restoPago;
                $movimiento->caja_id = $caja->id;
                $movimiento->tipo = 'entrada';
                $movimiento->monto = $restoPago;
                $movimiento->venta_id = $pedido->id;
                $movimiento->user_id = $request->usuarioPedido;
                $movimiento->hora = $fecha->format('H:i');
                $movimiento->fecha = $fecha->format('d-m-Y');
                $movimiento->save();
            }
        }
        if ($request->entregado) {
            $pedido->entregado = 1;
            $pedido->userVenta_id = $request->usuarioPedido;
            $pedido->fecha_venta = $fecha->format('d-m-Y');
            $pedido->hora_venta = $fecha->format('H:i');
        }
        $pedido->save();
        Flash::success("Se ha realizado la actualización del estado del pedido.");
        return redirect()->route('admin.pedidos.edit', $id);
    }

}
