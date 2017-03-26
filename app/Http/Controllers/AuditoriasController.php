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
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Auditorias')->where('id', $rol_id)->count() != 0){
            #PASA#
            $auditorias = Auditoria::all();
            if ($auditorias->count()==0){       //devuelve la cantidad de registros contenidos en la cadena
                return view('admin.auditorias.sinRegistros'); //se devuelve la vista para crear un registro
            } else {
                return view('admin.auditorias.tabla')->with('auditorias',$auditorias);  // se devuelven los registros
            }
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');
        }
    }

    public function show($id)
    {
        $rol_id = Auth::user()->rol->id;
        if(Auth::user()->rol->searchModulos('Auditorias')->where('id', $rol_id)->count() != 0){
            #PASA#
            $auditoria = Auditoria::find($id);
            return view('admin.auditorias.show')->with('auditoria',$auditoria);
        }
        else{
            dd("Usted NO tiene permisos para acceder a este subsistema");
            return view('admin.partes.noAutorizado');
        }
    }



}
