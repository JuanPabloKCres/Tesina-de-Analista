<?php

namespace App\Http\Controllers;

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
        ->orderBy('nombre','ASC')
        ->paginate();
        return response()->json(view('admin.movimientos.tablaRegistros',compact('movimientos'))->render());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movimientos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movimiento = new Movimiento($request->all());
        $movimiento->save();
        Flash::success('El movimiento ha sido registrado de forma existosa.');
        return redirect()->route('admin.cajas.index');
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
        return view('admin.movimientos.show')->with('movimiento',$movimiento);
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
