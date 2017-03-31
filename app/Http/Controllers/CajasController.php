<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Caja;
use App\User;
use App\Movimiento;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\Http\Requests\CajasRequestCreate;
use App\Http\Requests\CajasRequestEdit;
use Carbon\Carbon;

use Illuminate\Routing\Route;

class CajasController extends Controller
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
    public function index(Request $request)
    {
        if($request->ajax()){
            $caja = Caja::find($request->caja_id);
            $user_apertura = User::find($caja->userApertura_id);
            $user_cierre = User::find($caja->userCierre_id);

            $saldo_actual = $caja->totalMovimientos();
            //$user_cierre = User::find($request->userCierre_id);
            $datosCaja = array('fecha_apertura'=>$caja->fecha_apertura, 'hora_apertura'=>$caja->hora_apertura,
                'ingresos'=>$caja->totalEntrada(), 'egresos'=>$caja->totalSalida(),
                'saldo_inicial'=>$caja->saldo_inicial, 'saldo_cierre'=>$caja->saldo_cierre, 'saldo_actual'=>$saldo_actual,
                'user_apertura'=>$user_apertura->name, 'user_cierre'=>'null');
            return response()->json(json_encode($datosCaja, true));
        }
        else{
            $caja = Caja::where('cerrado', false)->first(); //Aca se busca el primer registro de caja que este activo (supuestamente debería ser el único, igual se pone asi para que no siga buscando al pedo)
            if ($caja===null){ //al llegar aca preguta si enncontro algo(si $caja no es un objeto vacio o null)
                return view('admin.cajas.create'); //se devuelve la vista para abrir una caja
            } else {
                return view('admin.cajas.index')->with('caja',$caja); // se devuelve la caja en cuestion.
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrosCajas()
    {
        $cajas = Caja::where('cerrado', true)->get();
        return view('admin.cajas.tablaRegistros')->with('cajas',$cajas);
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
        $caja = new Caja($request->all());
        $caja->save();
        Flash::success('Ha sido abierta una nueva caja.');
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
        $caja = Caja::find($id);
        return view('admin.cajas.show')->with('caja',$caja);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
