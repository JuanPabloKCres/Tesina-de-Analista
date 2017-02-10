<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;


class AuditoriasController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }

    public function index()
    {
        $auditorias = Auditoria::all();
        if ($auditorias->count()==0){       //devuelve la cantidad de registros contenidos en la cadena
            return view('admin.auditorias.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
            return view('admin.auditorias.tabla')->with('auditorias',$auditorias);  // se devuelven los registros
        }
    }

    public function show($id){
        $auditoria = Auditoria::find($id);
        return view('admin.auditorias.show')->with('auditoria',$auditoria);
    }



}
