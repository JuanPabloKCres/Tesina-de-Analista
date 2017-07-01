<?php

namespace App\Http\Controllers;

use App\Cheque;
use App\Auditoria;
use App\Cliente;
use App\ClienteRanking;
use App\Config;
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
use Mpociot\Reflection\DocBlock\Type\Collection;
use Faker\Provider\DateTime;
use App\ArticuloRanking;

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

    public function index(Request $request) {
        $configuracion_sistema = Config::all()->first();
        $pedidos = Venta::searchEntregado(0)    /**solo mandar a tablaPedidos los que no se entregaron */
                ->orderBy('id', 'DESC')
                ->paginate(Venta::searchEntregado(0)->orderBy('id', 'ASC')->count());
        $fecha1= "";
        $fecha2= "";
        $articulosVendidos = 0;
        $totalRecaudado = 0;
        $rankingClientes = [];
        $rankingArticulos = [];
        $ventas_entre_fechas = [];
        if(!is_null($request->fechaInicio)){
            $fecha1= $request->fechaInicio;
            $fecha1_en_datetime = Carbon::createFromFormat('Y-m-d', $fecha1);   //convertimos a datetime, para calculos con fecha
            //$fecha1 = date_format($fecha1_en_datetime, "d/m/Y");
            $fecha2= $request->fechaFin;
            $fecha2_en_datetime = Carbon::createFromFormat('Y-m-d', $fecha2);   //convertimos a datetime, para calculos con fecha
            //$fecha2 = date_format($fecha2_en_datetime, "d/m/Y");
            //dd($fecha1, $fecha2);
            /** si se pide un intervalo de fechas... */
            foreach ($pedidos as $pedido) {
                $fechaPedido = Carbon::createFromFormat('d/m/Y', $pedido->fecha_pedido);  //convertimos a datetime, para calculos con fecha
                if ( ( $fechaPedido >= $fecha1_en_datetime)&&($fechaPedido <= $fecha2_en_datetime)){ //se compara que la fecha del pedido se encuentre entre las fechas que determinan el rango
                    array_push($ventas_entre_fechas, $pedido);      //guardamos la pedido en un listado para pasar a la vista
                    //las dos posteriores variables son contadores que se irán incrementando a medida que transcurra el foreach
                    $articulosVendidos =  $articulosVendidos +  $pedido->cantidadArticulos();
                    $totalRecaudado = $totalRecaudado +  $pedido->importe();
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
                }
            }
            //se retornan la vista y los datos asociados a ella.
            return view('admin.pedidos.tablaPedidos')
                ->with('pedidos',$ventas_entre_fechas)
                ->with('totalRecaudado',$totalRecaudado)
                ->with('articulosVendidos',$articulosVendidos)
                ->with('fecha1',$fecha1)
                ->with('fecha2',$fecha2);
            /** Fin de filtrado de pedidos por intervalo de fechas */
        }else{
            $fechahoy =  \Carbon\Carbon::now('America/Buenos_Aires');
            //$fecha1= $fechahoy->format('d-m-Y');
            //$fecha2= $fechahoy->format('d-m-Y');
        }
        return view('admin.pedidos.tablaPedidos')
            ->with('fecha1',$fecha1)
            ->with('fecha2',$fecha2)
            ->with('pedidos', $pedidos)
            ->with('configuracion',$configuracion_sistema);
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
            if ($request->ajax()){
                /**Si se llama desde editar progreso de pedido**/
                if($request->progreso != null){
                    $id = $request->pedido_id;
                    $pedido = Venta::find($id);
                    $progreso_anterior = $pedido->progreso;
                    $pedido->progreso = $request->progreso;
                    $pedido->save();
                    Flash::success("Se ha actualizado el estado del pedido ".$progreso_anterior."% → ".$request->progreso."%");
                    return response()->json(json_encode("El progreso se actualizo satisfactoriamente!", true));
                }
                /**Fin-editar_progreso*/
                /**Si se intenta registrar segundo pago con cheque */
                if($request->completar_pago_c_cheque){
                    $id = $request->pedido_id;
                    $pedido = Venta::find($id);
                    $pedido->pagado = 1;
                    $caja = Caja::where('cerrado', false)->first(); //Aca se busca el primer registro de caja que este activo (supuestamente deberÃ­a ser el Ãºnico, igual se pone asi para que no siga buscando al pedo)
                    $fecha = \Carbon\Carbon::now('America/Buenos_Aires');
                    if ($caja === null) { //al llegar aca preguta si enncontro algo(si $caja no es un objeto vacio o null)
                        return view('admin.cajas.create'); //se devuelve la vista para abrir una caja
                    } else {
                        $restoPago = $pedido->importe() - $pedido->senado;
                        $pedido->pagado = 1;
                        $movimiento = new Movimiento();
                        $movimiento->concepto = "Se termino de pagar un pedido c/ cheque por $" . $restoPago;
                        $movimiento->caja_id = $caja->id;
                        $movimiento->tipo = 'entrada';
                        $movimiento->monto = $restoPago;
                        $movimiento->venta_id = $pedido->id;

                        $movimiento->user_id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
                        $movimiento->hora = $fecha->format('H:i');
                        $movimiento->fecha = $fecha->format('d/m/Y');
                        $movimiento->save();
                    }
                    $cheque = new Cheque();
                    $cheque->nro_serie = $request->nro_serie;             #OK
                    $cheque->monto = $request->sena;                      #OK
                    $cheque->banco_id = $request->banco;                  #OK
                    $cheque->sucursal = $request->sucursal_banco;         #OK
                    $cheque->cliente_id = $request->cliente_id;              #OK
                    $cheque->fecha_emision = $request->fecha_emision;     #OK
                    $cheque->fecha_cobro = $request->fecha_cobro;         #OK
                    $cheque->cobrado = 0;
                    $cheque->save();                                      #OK
                    $pedido->cheque_id = $cheque->id;    //se asocia la venta con el cheque nuevo cargado.   /** Ver esto, porque en caso de tener dos cheques ya no sirve! */*/
                    $pedido->save();
                    Flash::success("Se ha completado el pago con un cheque.");
                    return redirect()->route('admin.pedidos.edit', $id);
                }
                /** Fin segundo pago con cheque (showPedido.blade) */
                if($request->ingresar_cae) {
                    $pedido = Venta::find($request->pedido_id);
                    $pedido->nro_cae = $request->cae;//$request->cae;
                    $pedido->fecha_vencimiento_cae = $request->fecha_vencimiento_cae;
                    $fecha = \Carbon\Carbon::now('America/Buenos_Aires');
                    $pedido->fecha_facturacion = $fecha->format('d/m/Y');     #Falta TESTING
                    $pedido->hora_facturacion = $fecha->format('H:i');        #
                    $pedido->save();
                    $datosValidados = array("cae" => $request->cae, "fecha_vencimiento" => $request->fecha_vencimiento_cae);
                    return response()->json(json_encode($datosValidados, true));
                }
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
                    /**Si no se llamo desde el datepicker..quiere decir que se esta intentando GUARDAR UN PEDIDO*/
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
                    if ($request->pagado == "true") {
                        $venta->pagado = 1;
                    }else{
                        $venta->pagado = 0;
                    }
                    if ($request->entregado == "true") {    #if funciona OK
                        $venta->entregado = 1;
                    }else{
                        $venta->entregado = 0;
                    }

                    if($request->paga_en_cuentacorriente == "si") {      /**  (Pago en Cheque o a Credito Cuenta Corriente) */
                        ////////////////////////////////// CHEQUE ////////////////////////////////////
                        if ($request->nro_serie) {
                            if ($request->pagado == "true") {
                                $forma_pago = "Totalidad en cheque";
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
                            $cheque->cobrado = 0;
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
                        else{
                            if ($request->pagado == "true") {
                                $forma_pago = "Totalidad con Cuenta Corriente";
                            } else {
                                $forma_pago = "Seña c/ Cuenta Corriente";
                            }
                        }
                        ////// GUARDAMOS MOVIMIENTO EN CUENTA CORRIENTE EN AMBOS CASOS (CHEQUE/ o crédito CC) //////
                        $cliente = Cliente::find($request->cliente);
                        $movimiento->ccorriente_id = $cliente->cuentaCorriente->id;
                        $movimiento->cuenta_corriente_id = $cliente->cuentaCorriente->id; //*VER

                        $movimiento->tipo = 'salida';
                        $movimiento->forma = 'CC';
                        $movimiento->monto = $venta->senado;

                        $movimiento->user_id = $request->usuarioPedido;
                        $movimiento->hora = $fecha->format('H:i');
                        $movimiento->fecha = $fecha->format('d/m/Y');
                        $movimiento->concepto = "pago".' '.$forma_pago;

                        ////////////////////////////////////////////////////////////////////////////////
                    }
                    if($request->paga_en_cuentacorriente == "no"){ /**  (Pago en Efectivo) */
                        if ($request->pagado == "true") {
                            $forma_pago = "Totalidad Efectivo";
                        } else {
                            $forma_pago = "Seña en Efectivo";
                        }
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
                    $movimiento->venta_id = $venta->id;
                    $movimiento->save();
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
                    if (($venta->senado > 0) && ($request->paga_en_cuentacorriente == "no")) {
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
                    $datos_pedido_para_enviar_a_vista = array('pedido_id' => $venta->id);
                    return response()->json(json_encode($datos_pedido_para_enviar_a_vista, true));

                    if (($request->pagado == "true") && ($request->entregado == "true")) {
                        return response()->json("¡La venta fue registrada con exito!");
                    } else {
                        return response()->json("¡El pedido fue registrado con exito!");
                    }
                }
            }

            $pedidos = Venta::all();//Venta::searchEntregado(0);//agregado domingo 10 a la noche
            $configuracion_sistema = Config::all()->first();
            return view('admin.pedidos.createPedido')
                ->with('pedidos',$pedidos)
                ->with('configuracion',$configuracion_sistema); // Menu principal de 'Pedidos'
        }
    }

    public function show() {

    }
    public function destroy() {

    }

    public function store(Request $request) {
        return response()->json("Exito PRUEBA!");
    }

    public function edit(Request $request, $id) {

        if($request->ajax()){
            dd($request);

        }

        $pedido = Venta::find($id);
        return view('admin.pedidos.showPedido')->with('pedido', $pedido);
    }

    public function update(Request $request, $id) {
        if($request->ajax()){
            //dd($request);
            if($request->cancelarPedido){
                $pedido = Venta::find($id);
                $pedido->entregado = "-1";
                $pedido->pagado = "-1";
                //falta la reposicion de stock al cancelar el pedido
                $pedido->save();
                //return response()->json("Exito PRUEBA!");
            }
            if($request->progreso){
                $id = $request->pedido_id;
                $pedido = Venta::find($id);
                $pedido->progreso = $request->progreso;
                $pedido->save();
                Flash::success("Se ha actualizado el estado del pedido.");
                return redirect()->route('admin.pedidos.edit', $id);
            }
        }

        else{
            if($request->progreso != null){
                dd($request);
                $id = $request->pedido_id;
                $pedido = Venta::find($id);
                $pedido->progreso = $request->progreso;
                $pedido->save();
                Flash::success("Se ha actualizado el estado del pedido.");
                return redirect()->route('admin.pedidos.edit', $id);
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

            if($request->entregado == '1') {
                $pedido->fecha_venta = $fecha->format('d-m-Y');
                $pedido->hora_venta = $fecha->format('H:i');
                $pedido->entregado = 1;
                $pedido->progreso = 100;
                $pedido->userVenta_id = $request->usuarioPedido;
                if($pedido->pagado == '0'){ #Si no se habia pagado completamente añadir que se termino de pagar por efectivo
                    $pedido->forma_pago = $pedido->forma_pago. " y saldo en efectivo";
                }
            }
            if($request->entregado == '-1') {
                $pedido->entregado = -1;
                $pedido->progreso = 0;
            }
            if($pedido->pagado == '1'){ #Si no se habia pagado completamente añadir que se termino de pagar por efectivo
                $pedido->forma_pago = $pedido->forma_pago. " y saldo en efectivo";
            }

            $pedido->save();
            Flash::success("Se ha actualizado el estado del pedido.");
            return redirect()->route('admin.pedidos.edit', $id);
        }

    }
}
