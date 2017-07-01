<?php

namespace App\Http\Controllers;

use App\Cliente;
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

class CCorrientesController extends Controller
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
        $cuentascorrientes = CuentaCorriente::all(); //Aca se busca el primer registro de caja que este activo (supuestamente debería ser el único, igual se pone asi para que no siga buscando al pedo)
        $clientes = Cliente::all();
        return view('admin.cuentasCorrientes.index')
            ->with('clientes',$clientes)
            ->with('cuentascorrientes',$cuentascorrientes);

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
    public function registrosCC()
    {

    }
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
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|max:50|unique:ccorrientes',
            'saldo' => 'required',
            'fecha_apertura' => 'required',
            'hora_apertura' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/ccorrientes')
                ->withErrors("El cliente ya tiene una cuenta corrente")
                ->withInput();
        }
        $cuentacorriente = new CuentaCorriente();


        $cuentacorriente->cliente_id = $request->cliente_id;
        $cuentacorriente->fecha_apertura = $request->fecha_apertura;
        $cuentacorriente->hora_apertura = $request->hora_apertura;
        $cuentacorriente->debe = 0;
        $cuentacorriente->haber = 0;
        $cuentacorriente->saldo = $request->saldo;
        $cuentacorriente->activa = true;
        $cuentacorriente->userApertura_id = $request->user_id;


        $cuentacorriente->save();
        Flash::success('Se abrio una nueva cuenta corriente exitosamente.');
        return redirect()->route('admin.ccorrientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuentacorriente = CuentaCorriente::find($id);
        return view('admin.cuentascorrientes.show')->with('cuentacorriente',$cuentacorriente);
    }


    public function edit()
    {
        $cuentascorrientes = CuentaCorriente::all();
        return view('admin.cuentasCorrientes.tablaRegistros')->with('cuentascorrientes',$cuentascorrientes);
    }


    public function update(Request $request, $id)
    {
        $caja = Caja::find($id); //recupero la caja
        $caja->fill($request->all()); // guardo la fecha y hora de cierre
        $caja->cerrado = true;
        $caja->save(); // actualizamos el objeto caja con los valores recolectados y se persiste

        Flash::success("Se ha realizado el cierre del registro de caja.");

        return redirect()->route('admin.cajas.show', $id);
    }


    public function destroy($id)
    {
        $caja = Caja::find($id);
        $caja->delete();
        Flash::error("Se ha realizado la eliminación del registro de caja.");
        return redirect()->route('admin.cajas.index');
    }
}
