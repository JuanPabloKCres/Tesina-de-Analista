<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Laracasts\Flash\Flash;
use App\Http\Requests\PassRequest;
use App\Http\Requests\UserRequestCreate;
use App\Http\Requests\UserRequestEdit;
use Carbon\Carbon;
use App\Auditoria;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    public function __construct()
    {
        Carbon::setlocale('es'); // Instancio en Español el manejador de fechas de Laravel
    }

    public function index()
    {
        $users = User::all();
        $roles = Rol::all()->lists('nombre','id');
        if ($users->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
             return view('admin.usuarios.sinRegistros')->with('roles', $roles); //se devuelve la vista para crear un registro
        } else {
             return view('admin.usuarios.tabla')->with('usuarios', $users)->with('roles', $roles); // se devuelven los registros
        }   
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(UserRequestCreate $request)
    {
        $nombreImagen = 'sin imagen';
        if ($request->file('imagen'))
        {
            $file = $request->file('imagen');        
            $nombreImagen = 'usuario_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('usuarios')->put($nombreImagen, \File::get($file));
        }  

        $user = new User($request->all());
        $user->name = $request->apellido.' '.$request->nombre;
        $user->password = bcrypt($request->password);
        $user->rol_id = $request->rol_id;
        $user->imagen = $nombreImagen;
        $user->save();
        Flash::success("¡Se ha registrado al usuario ".$user->usuario." de forma existosa!");
        /** Auditoria almacena creacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "users";
        $auditoria->elemento_id = $user->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "alta";
        $auditoria->dato_nuevo = "nombre: ".$user->name." || email: ".$user->email." || password: ".$user->password." || imagen:".$user->imagen." || rol_id:".$user->rol_id;
        $auditoria->save();
        return redirect()->route('admin.usuarios.index');
    }

    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show')->with('usuario',$usuario);
    }

    public function actPass(PassRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        Flash::success("Se ha realizado la actualización del password.");
        return redirect()->route('admin.usuarios.show', $id);
    }

    public function update(UserRequestEdit $request, $id)
    {
        $usuario = User::find($id);
        if ($request->file('imagen'))
        {
            $file = $request->file('imagen');        
            $nombreImagen = 'usuario_' . time() . '.' . $file->getClientOriginalExtension();            
            if (Storage::disk('usuarios')->exists($usuario->imagen))
             {
                Storage::disk('usuarios')->delete($usuario->imagen);   // Borramos la imagen anterior.      
             }
            $usuario->fill($request->all());
            $usuario->imagen = $nombreImagen;  // Actualizamos el nombre de la nueva imagen.
            Storage::disk('usuarios')->put($nombreImagen, \File::get($file));  // Movemos la imagen nueva al directorio /imagenes/usuarios   
            $usuario->save();
            Flash::success("Se ha realizado la actualización del usuario: ".$usuario->name.".");
            return redirect()->route('admin.usuarios.show', $id);            
        }
        $dato_anterior =  "nombre: ".$usuario->name." || email: ".$usuario->email." || password: ".$usuario->password." || imagen:".$usuario->imagen." || rol_id:".$usuario->rol_id;
        $usuario->fill($request->all());
        $usuario->save();
        Flash::success("Se ha realizado la actualización del usuario: ".$usuario->name.".");
        /** Auditoria actualizacion */
        $auditoria = new Auditoria();
        $auditoria->tabla = "users";
        $auditoria->elemento_id = $usuario->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "modificacion";
        $auditoria->dato_nuevo =  "nombre: ".$usuario->name." || email: ".$usuario->email." || password: ".$usuario->password." || imagen:".$usuario->imagen." || rol_id:".$usuario->rol_id;
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        return redirect()->route('admin.usuarios.show', $id);
    }


    public function destroy($id)
    {
        $usuario = User::find($id);
        $dato_anterior = "nombre: ".$usuario->name." || email: ".$usuario->email." || password: ".$usuario->password." || imagen:".$usuario->imagen." || rol_id:".$usuario->rol_id;
        if ($usuario->imagen != 'sin imagen')
        {            
            Storage::disk('usuarios')->delete($usuario->imagen); // Borramos la imagen asociada.
        }
        $usuario->delete();
        /** Auditoria eliminación */
        $auditoria = new Auditoria();
        $auditoria->tabla = "users";
        $auditoria->elemento_id = $usuario->id;
        $autor = new Auth();
        $autor->id = Auth::user()->id;          //Conseguimos el id del usuario actualmente logueado
        $auditoria->usuario_id = $autor->id;    //lo asignamos a la auditorias
        $auditoria->accion = "eliminacion";
        $auditoria->dato_anterior = $dato_anterior;
        $auditoria->save();
        Flash::error("Se ha realizado la eliminación del usuario: ".$usuario->name.".");        
        return redirect()->route('admin.usuarios.index');
    }
}
