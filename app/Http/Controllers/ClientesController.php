<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Localidad;
use App\Cliente;
use App\Venta;
use App\Responiva;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use League\Flysystem\Adapter\Local;
use App\Http\Requests\ClienteRequestCreate;
use App\Http\Requests\ClienteRequestEdit;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller {
    public function __construct() {
        Carbon::setlocale('es');         // Instancio en Espa�ol el manejador de fechas de Laravel
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $cliente = Cliente::find($request->id);
            $nombre = $cliente->apellido . " " . $cliente->nombre;
            $n = $cliente->nombre;
            $a = $cliente->apellido;
            $responiva = $cliente->responiva->nombre;
            $iva = $cliente->responiva->iva;
            $empresa = $cliente->empresa;
            $dni = "";
            $direccion = "";
            $localidad = "";
            $provincia = "";
            $tipo_cbte = $cliente->responiva->factura;
            if ($cliente->cuit) {
                $dni = $cliente->cuit;
            } else {
                $dni = $cliente->dni;
            }
            if ($cliente->direccion) {
                $direccion = $cliente->direccion;
            } else {
                $domicilio = "No registrado";
            }
            if ($cliente->localidad) {
                $localidad = $cliente->localidad->nombre;
            } else {
                $localidad = "No registrado";
            }
            if ($cliente->provincia) {
                $provincia = $cliente->localidad->provincia_id->nombre;
            } else {
                $provincia = "No registrado";
            }

            $datosValidados = array("nombre" => $nombre, "n" =>$n, "a" => $a, "empresa"=>$empresa, "dni" => $dni, "domicilio" => $direccion, "localidad" => $localidad, "provincia" => $provincia, "tipo_cbte" => $tipo_cbte, "responiva"=>$responiva, "iva"=>$iva);
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
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "clientes";
        $auditoria->elemento_id = $cliente->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$cliente->nombre." || apellido: ".$cliente->apellido." || empresa: ".$cliente->empresa." || responsabilidad tributaria:".$cliente->responiva_id." || CUIT:".$cliente->cuit." || DNI: ".$cliente->dni." || descripcion: ".$cliente->descripcion." || teléfono: ".$cliente->telefono." || email: ".$cliente->email." || localidad_id: ".$cliente->localidad_id." || direccion: ".$cliente->direccion;
        $auditoria->dato_anterior = null;
        $auditoria->save();
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
        $dato_anterior =  "nombre: ".$cliente->nombre." || apellido: ".$cliente->apellido." || empresa: ".$cliente->empresa." || responsabilidad tributaria:".$cliente->responiva_id." || CUIT:".$cliente->cuit." || DNI: ".$cliente->dni." || descripcion: ".$cliente->descripcion." || teléfono: ".$cliente->telefono." || email: ".$cliente->email." || localidad_id: ".$cliente->localidad_id." || direccion: ".$cliente->direccion;
        $cliente->fill($request->all());
        $cliente->save();
        Flash::success('Los datos del cliente "' . $cliente->nombre . ' ' . $cliente->apellido . '" ha sido actualizados de forma existosa.');

        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "clientes";
        $auditoria->elemento_id = $cliente->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo = "nombre: ".$cliente->nombre." || apellido: ".$cliente->apellido." || empresa: ".$cliente->empresa." || responsabilidad tributaria:".$cliente->responiva_id." || CUIT:".$cliente->cuit." || DNI: ".$cliente->dni." || descripcion: ".$cliente->descripcion." || teléfono: ".$cliente->telefono." || email: ".$cliente->email." || localidad_id: ".$cliente->localidad_id." || direccion: ".$cliente->direccion;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.clientes.show', $id);
    }

    public function destroy($id) {
        $cliente = Cliente::find($id);
        $dato_anterior = "nombre: ".$cliente->nombre." || apellido: ".$cliente->apellido." || empresa: ".$cliente->empresa." || responsabilidad tributaria:".$cliente->responiva_id." || CUIT:".$cliente->cuit." || DNI: ".$cliente->dni." || descripcion: ".$cliente->descripcion." || teléfono: ".$cliente->telefono." || email: ".$cliente->email." || localidad_id: ".$cliente->localidad_id." || direccion: ".$cliente->direccion;
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "clientes";
        $auditoria->elemento_id = $cliente->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        $cliente->delete();
        Flash::error(('Se ha dado de baja al cliente "' . $cliente->nombre . ' ' . $cliente->apellido . '" de forma existosa.'));

        return redirect()->route('admin.clientes.index');
    }

}
