<?php

namespace App\Http\Controllers;

use App\CuentaCorriente;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movimiento;
use App\Caja;
use Laracasts\Flash\Flash;
use App\Http\Requests\MovimientoRequestCreate;
use App\Http\Requests\MovimientoRequestEdit;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class MovimientosController extends Controller
{

    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)  //la solicitud se realiza utilizando ajax se devuelven los registros únicamente a la tabla.
    {
        $movimientos = Movimiento::where('caja_id', $id)
        ->orderBy('id','ASC')
        ->paginate();
        return response()->json(view('admin.movimientos.tablaRegistros',compact('movimientos'))->render());
    }

    public function create()
    {
        return view('admin.movimientos.create');
    }

    public function store(Request $request) //agregar movimiento a CC y/o a Caja
    {
        $movimiento = new Movimiento($request->all());
        if($request->tipo == 'entrada'){                //esto esta para revisar que si un movimiento es entrada CC tambien se cargue ese efectivo a la caja abierta.
            $caja = Caja::where('cerrado',0)->first();
            $movimiento->caja_id = $caja->id;
        }
        if($request->cc_id){
            $cuentacorriente = CuentaCorriente::find($request->cc_id);
            $movimiento->forma = 'CC';
            $movimiento->ccorriente_id = $request->cc_id;
            $movimiento->cuenta_corriente_id = $request->cc_id; //*VER
            $movimiento->save();
            Flash::success('El movimientos ha sido registrado de forma existosa.');
            return redirect()->route('admin.ccorrientes.show',$request->cc_id);
        }
        else {
            $caja = Caja::find($request->caja_id);
            if (($caja->totalMovimientos() < $movimiento->monto) && ($movimiento->tipo == 'salida')) {
                Flash::success('No se puede sacar un monto mayor al existente en caja.');
                return redirect()->route('admin.cajas.index');
            } else {
                $movimiento->save();
                Flash::success('El movimientos ha sido registrado de forma existosa.');
                return redirect()->route('admin.cajas.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimiento = Movimiento::find($id);
        return view('admin.movimientos.show')->with('movimientos',$movimiento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
