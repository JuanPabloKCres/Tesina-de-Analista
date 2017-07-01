<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cheque;
use App\CuentaCorriente;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Caja;
use App\User;
use App\Movimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use App\Http\Requests\CajasRequestCreate;
use App\Http\Requests\CajasRequestEdit;
use Carbon\Carbon;


use Illuminate\Routing\Route;

class ChequesController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Cajas')->where('id', $rol_id)->count() != 0 || Auth::user()->rol->searchModulos('Ventas')->where('id', $rol_id)->count() != 0){
            #PASA#
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if($request->ajax()){   //modificar a pagado
            $caja = Caja::where('cerrado', false)->first(); //Aca se busca el primer registro de caja que este activo (supuestamente deberÃ­a ser el Ãºnico, igual se pone asi para que no siga buscando al pedo)
            if ($caja === null) { //al llegar aca preguta si enncontro algo(si $caja no es un objeto vacio o null)
                return view('admin.cajas.create'); //se devuelve la vista para abrir una caja
            } else {
                $fecha = \Carbon\Carbon::now('America/Buenos_Aires');
                $cheque = Cheque::find($request->cheque_id);
                $cheque->cobrado = '1';
                $cheque->save();
                $movimiento = new Movimiento();
                $movimiento->tipo = 'entrada';
                $movimiento->caja_id = $caja->id;
                $movimiento->monto = $cheque->monto;
                $movimiento->user_id = Auth::user()->id;
                $movimiento->hora = $fecha->format('H:i');
                $movimiento->fecha = $fecha->format('d/m/Y');
                $movimiento->concepto = "Cobro de Cheque de cliente ".$cheque->cliente->nombre." ".$cheque->cliente->apellido;
                $movimiento->save();
                /**salida de cuenta corriente*/
                $movimiento = new Movimiento();
                $movimiento->tipo = 'entrada';
                $movimiento->forma = 'CC';
                $movimiento->ccorriente_id = $cheque->cuentacorriente->id;
                $movimiento->monto = $cheque->monto;
                $movimiento->user_id = Auth::user()->id;
                $movimiento->hora = $fecha->format('H:i');
                $movimiento->fecha = $fecha->format('d/m/Y');
                $movimiento->concepto = "Cancelacion de deuda por cobro cheque ";
                $movimiento->save();

                $data = array("cheque" => $cheque);
                return response()->json(json_encode($data, true));
            }
        }
        else{
            $cheques = Cheque::all(); //Aca se busca el primer registro de caja que este activo (supuestamente debería ser el único, igual se pone asi para que no siga buscando al pedo)
            $clientes = Cliente::all();
            return view('admin.cheques.index')
                ->with('clientes',$clientes)
                ->with('cheques',$cheques);
        }


        /*
        if ($cuentascorrientes === null){ //al llegar aca preguta si enncontro algo(si $caja no es un objeto vacio o null)
            return view('admin.cuentasCorrientes.create'); //se devuelve la vista para abrir una caja
        } else {
            return view('admin.cuentasCorrientes.index')->with('cuentascorrientes',$cuentascorrientes);
        }
        */

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    public function edit(Request $request)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }
}
