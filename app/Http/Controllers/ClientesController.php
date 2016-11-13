<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Localidad;
use App\Cliente;
use App\Responiva;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use League\Flysystem\Adapter\Local;
use App\Http\Requests\ClienteRequestCreate;
use App\Http\Requests\ClienteRequestEdit;

class ClientesController extends Controller {

    public function __construct() {
        Carbon::setlocale('es');         // Instancio en Espa�ol el manejador de fechas de Laravel
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $cliente = Cliente::find($request->id);
            $nombre = $cliente->apellido . " " . $cliente->nombre;
            $dni = "";
            $domicilio = "";
            $tipo_cbre = $cliente->responiva->factura;
            if ($cliente->cuit) {
                $dni = $cliente->cuit;
            } else {
                $dni = $cliente->dni;
            }
            if ($cliente->domicilio) {
                $domicilio = $cliente->domicilio;
            } else {
                $domicilio = "No registrado";
            }

            $datosValidados = array("nombre" => $nombre, "dni" => $dni, "domicilio" => $domicilio, "tipo_cbre" => $tipo_cbre);
            return response()->json(json_encode($datosValidados, true));
        }
        $clientes = Cliente::all();
        if ($clientes->count() == 0) { // la funcion count te devuelve la cantidad de registros contenidos en la cadena
            return view('admin.clientes.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.clientes.tabla')->with('clientes', $clientes); // se devuelven los registros
        }
    }

    public function create(Request $request) {
        $cliente = new Cliente($request->all());
        $cliente->save();
        return response()->json(view('admin.pedidos.clienteSeleccionado', compact('cliente'))->render());
    }

    public function store(Request $request) {
        $cliente = new Cliente($request->all());
        $cliente->save();
        Flash::success('El cliente "' . $cliente->nombre . ' ' . $cliente->apellido . '" ha sido registrado de forma existosa.');
        return redirect()->route('admin.clientes.index');
    }

    public function show($id) {
        $cliente = Cliente::find($id);
        $localidades = Localidad::all()->lists('nombre', 'id');
        return view('admin.clientes.show')
                        ->with('cliente', $cliente)
                        ->with('localidades', $localidades);
    }

    public function update(ClienteRequestEdit $request, $id) {
        $cliente = Cliente::find($id);
        $cliente->fill($request->all());
        $cliente->save();
        Flash::success('Los datos del cliente "' . $cliente->nombre . ' ' . $cliente->apellido . '" ha sido actualizados de forma existosa.');
        return redirect()->route('admin.clientes.show', $id);
    }

    public function destroy($id) {
        $cliente = Cliente::find($id);
        $cliente->delete();
        Flash::error(('Se ha dado de baja al cliente "' . $cliente->nombre . ' ' . $cliente->apellido . '" de forma existosa.'));

        return redirect()->route('admin.clientes.index');
    }

}
