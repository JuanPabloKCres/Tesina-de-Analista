<?php

namespace App\Http\Controllers;

use App\Cheque;
use App\Auditoria;
use App\Cliente;
use App\CuentaCorriente;
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
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\Http\Requests\VentaRequestCreate;
use App\Http\Requests\VentaRequestEdit;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class PedidosController extends Controller {

    public function __construct() {
        Carbon::setlocale('es');
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Ventas')->where('id', $rol_id)->count() != 0){
            #PASA#
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');
        }
    }

    public function index() {
        $pedidos = Venta::searchEntregado(0)    /**solo mandar a tablaPedidos los que no se entregaron */
                ->orderBy('id', 'desc')
                ->paginate(Venta::searchEntregado(0)->count());
        return view('admin.pedidos.tablaPedidos')->with('pedidos', $pedidos);
    }


    public function create(Request $request) {
        $caja = Caja::where('cerrado', false)->first(); //Aca se busca el primer registro de caja que este activo (supuestamente deberÃ­a ser el Ãºnico, igual se pone asi para que no siga buscando al pedo)
        if ($caja === null) { //al llegar aca preguta si enncontro algo(si $caja no es un objeto vacio o null)
            return view('admin.cajas.create'); //se devuelve la vista para abrir una caja
        } else {
            /*
             * Si la solicitud se realiza a travÃ©s de ajax quiere decir que que se quiere persistir un nuevo pedido.
             * En caso contrario se devuelve la pantalla para realizar un pedido.
             */
            if ($request->ajax()) {
                if ($request->buscar_datepicker) {      //si se llama desde el datepicker de crear un pedido
                    $pedidos = Venta::all();
                    $cantidad = 0;
                    $articulos =0;
                    foreach($pedidos as $pedido){
                        if($pedido->fecha_entrega_estimada == $request->dia){
                            $cantidad = $cantidad + 1;
                            $articulos = $articulos + $pedido->articulos_ventas->count();
                        }
                    }
                    $data = array("cantidad" => $cantidad, "articulos"=>$articulos);
                    return response()->json(json_encode($data, true)); //retornar cantidad de pedidos pendientes para la fecha que se escogio desde la vista
                }
                if($request->sugerir_fecha_entrega){
                    $pedidos = Venta::searchEntregado(0)->get();
                    $horas_produccion = Venta::horasTrabajoPendientesEntrega($pedidos) + $request->horas_produccion;    //las HP que tenia de pedidos anteriores  + las HP que me representa el nuevo pedido que estoy tomando
                    $dias = $horas_produccion / 7;    //7hs jornada de jornada laboral diaria;
                    $dias = round($dias);
                    $data = array("horas_produccion" => $horas_produccion, "dias"=>$dias);
                    return response()->json(json_encode($data, true));
                }
                else{
                    /**Si no se llamo desde el datepicker..quiere decir que se esta intentando guardar un PEDIDO*/
                    /** Primero se recoge en una variable el array de renglones y se crea y se persiste el
                     * registro de pedido/venta.*/
                    $arrayRenglones = $request->renglones;
                    $fecha = \Carbon\Carbon::now('America/Buenos_Aires');
                    $venta = new Venta();
                    $movimiento = new Movimiento();
                    $venta->fecha_pedido = $fecha->format('d/m/Y');     #OK 20 febrero
                    $venta->hora_pedido = $fecha->format('H:i');        #OK 20 febrero
                    $venta->fecha_entrega_estimada = $request->fecha_entrega_estimada;  #OK, guarda en formato AÃ±o-mes-dia *20 febrero
                    $venta->senado = $request->sena;                    #OK 20 febrero
                    $venta->userPedido_id = $request->usuarioPedido;    #OK 20 febrero
                    $venta->cliente_id = $request->cliente;             #OK 20 febrero

                    $venta->progreso = 0;             #nuevo→ 1/05
                    $venta->horas_produccion = $request->horas_produccion;             #nuevo→ 1/05

                    $conceptoMovimiento = "";
                    if ($request->pagado == "true") {   #if funciona OK
                        $venta->pagado = 1;
                    }
                    if ($request->entregado == "true") {    #if funciona OK
                        $venta->entregado = 1;
                    }
                    ////////////////////////////////// CHEQUE ////////////////////////////////////
                    if ($request->nro_serie) {
                        if ($request->pagado == "true") {
                            $forma_pago = "totalidad en cheque";
                        } else {
                            $forma_pago = "seña c/ cheque";
                        }
                        $cheque = new Cheque();
                        $cheque->nro_serie = $request->nro_serie;             #OK
                        $cheque->monto = $request->sena;                      #OK
                        $cheque->banco_id = $request->banco;                  #OK
                        $cheque->sucursal = $request->sucursal_banco;         #OK
                        $cheque->cliente_id = $request->cliente;              #OK
                        $cheque->fecha_emision = $request->fecha_emision;     #OK
                        $cheque->fecha_cobro = $request->fecha_cobro;         #OK
                        $cheque->save();                                      #OK
                        $venta->cheque_id = $cheque->id;    //se asocia la venta con el cheque nuevo cargado.
                        /** Auditoria almacena cheque */
                        $auditoria = new Auditoria();
                        $auditoria->tabla = "cheques";
                        $auditoria->elemento_id = $cheque->id;
                        $autor = new Auth();
                        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
                        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
                        $auditoria->accion = "alta";
                        $auditoria->dato_nuevo = "nro_serie: " . $cheque->nro_serie . " || monto: " . $cheque->monto . " || cliente_id: " . $cheque->cliente_id . " || fecha_emision: " . $cheque->fecha_emision . " || fecha_cobro: " . $cheque->fecha_cobro . " || banco_id: " . $cheque->banco_id . " || sucursal: " . $cheque->sucursal;
                        $auditoria->dato_anterior = null;
                        $auditoria->save();
                        ////////////////////////////////////////////////////////////////////////////
                    }
                    elseif($request->paga_en_cuentacorriente == true) {
                        if ($request->pagado == "true") {
                            $forma_pago = "totalidad con Cuenta Corriente";
                        } else {
                            $forma_pago = "seña c/ Cuenta Corriente";
                        }
                        //$cuenta_corriente = CuentaCorriente::where('cliente_id', $request->cliente);
                        $cliente = Cliente::find($request->cliente);
                        $movimiento->ccorriente_id = $cliente->cuentaCorriente->id;
                        $movimiento->tipo = 'entrada';
                        $movimiento->forma = 'CC';
                        $movimiento->monto = $venta->senado;
                        $movimiento->venta_id = $venta->id;
                        $movimiento->user_id = $request->usuarioPedido;
                        $movimiento->hora = $fecha->format('H:i');
                        $movimiento->fecha = $fecha->format('d/m/Y');
                        $movimiento->concepto = "pago".' '.$forma_pago;
                        $movimiento->save();
                    }
                    else{
                        $forma_pago = "efectivo";
                    }
                    $venta->forma_pago = $forma_pago;

                    if (($request->pagado == "true") && ($request->entregado == "true")) {
                        $venta->userVenta_id = $request->usuarioPedido;
                        $venta->fecha_venta = $fecha->format('d-m-Y');
                        $venta->hora_venta = $fecha->format('H:i');
                        $conceptoMovimiento = "Venta de artículos por un monto de $" . $venta->senado;
                    } else {
                        $conceptoMovimiento = "Pago por anticipado de un pedido por un monto de $" . $venta->senado;
                    }
                    $venta->save();     //no esta guardando cuando es venta!!!!!!!!!!!!!!
                    /** Auditoria almacena venta */
                    $auditoria = new Auditoria();
                    $auditoria->tabla = "ventas";
                    $auditoria->elemento_id = $venta->id;
                    $autor = new Auth();
                    $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
                    $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
                    $auditoria->accion = "alta";
                    $auditoria->dato_nuevo = "fecha_pedido: " . $venta->fecha_pedido . " || hora_pedido: " . $venta->hora_pedido . " || fecha entrega estimada: " . $venta->fecha_entrega_estimada . " || seÃ±ado: " . $venta->senado . " || usuario que tomo pedido: " . $venta->userPedido_id . " || cliente_id: " . $venta->cliente_id;
                    $auditoria->dato_anterior = null;
                    $auditoria->save();

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
                     * En este sector se completan los campos y se registra el movimientos en la caja.
                     */
                    if (($venta->senado > 0) && ($request->paga_en_cuentacorriente != true)) {
                        $movimiento->caja_id = $caja->id;
                        $movimiento->tipo = 'entrada';
                        $movimiento->monto = $venta->senado;
                        $movimiento->venta_id = $venta->id;
                        $movimiento->user_id = $request->usuarioPedido;
                        $movimiento->hora = $fecha->format('H:i');
                        $movimiento->fecha = $fecha->format('d/m/Y');
                        $movimiento->concepto = $conceptoMovimiento;
                        $movimiento->save();
                    }
                    /** Una vez completado el proceso se procede con redireccionar a la pantalla de pedidos.*/
                    if (($request->pagado == "true") && ($request->entregado == "true")) {
                        return response()->json("¡La venta fue registrada con exito!");
                    } else {
                        return response()->json("¡El pedido fue registrado con exito!");
                    }
                }
            }

            $pedidos = Venta::all();//Venta::searchEntregado(0);//agregado domingo 10 a la noche
            return view('admin.pedidos.createPedido')->with('pedidos',$pedidos); // Menu principal de 'Pedidos'
        }
    }

    public function show() {

    }
    public function destroy() {

    }

    public function store(Request $request) {
        return response()->json("Exito PRUEBA!");
    }

    public function edit($id) {
        $pedido = Venta::find($id);
        return view('admin.pedidos.showPedido')->with('pedido', $pedido);
    }

    public function update(Request $request, $id) {
        if($request->ajax()){
            if($request->cancelarPedido == true){
                $pedido = Venta::find($id);
                $pedido->entregado = "-1";
                $pedido->pagado = "-1";
                //falta la reposicion de stock al cancelar el pedido
                $pedido->save();
            }
        }
        $pedido = Venta::find($id);
        $fecha = \Carbon\Carbon::now('America/Buenos_Aires');
        if ($request->pagado) {
            $caja = Caja::where('cerrado', false)->first(); //Aca se busca el primer registro de caja que este activo (supuestamente deberÃ­a ser el Ãºnico, igual se pone asi para que no siga buscando al pedo)
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
                $movimiento->fecha = $fecha->format('d/m/Y');
                $movimiento->save();
            }
        }
        if($request->entregado) {
            if($request->entregado == '1') {
                $pedido->entregado = 1;
                $pedido->progreso = 100;
            }
            else{
                $pedido->entregado = 0;
            }
            $pedido->userVenta_id = $request->usuarioPedido;
            if($pedido->pagado == '0'){ #Si no se habia pagado completamente añadir que se termino de pagar por efectivo
                $pedido->forma_pago = $pedido->forma_pago. " y saldo en efectivo";
            }
            $pedido->fecha_venta = $fecha->format('d/m/Y');
            $pedido->hora_venta = $fecha->format('H:i');
        }
        $pedido->save();
        Flash::success("Se ha actualizado el estado del pedido.");
        return redirect()->route('admin.pedidos.edit', $id);
    }
}
