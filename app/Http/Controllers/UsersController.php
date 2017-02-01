<?php

namespace App\Http\Controllers;

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

class UsersController extends Controller
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
    public function index()
    {
        $users = User::all();
        if ($users->count()==0){ // la funcion count te devuelve la cantidad de registros contenidos en la cadena
             return view('admin.usuarios.sinRegistros'); //se devuelve la vista para crear un registro
        } else {
             return view('admin.usuarios.tabla')->with('usuarios',$users); // se devuelven los registros
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $user->nivel_acceso_id = $request->nivel_acceso;
        $user->imagen = $nombreImagen;
        $user->save();

        Flash::success("¡Se ha registrado al usuario ".$user->usuario." de forma existosa!");
        return redirect()->route('admin.usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show')->with('usuario',$usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actPass(PassRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        Flash::success("Se ha realizado la actualización del password.");
        return redirect()->route('admin.usuarios.show', $id);
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
        $usuario->fill($request->all());
        $usuario->save();
        Flash::success("Se ha realizado la actualización del usuario: ".$usuario->name.".");
        return redirect()->route('admin.usuarios.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario->imagen != 'sin imagen')
        {            
            Storage::disk('usuarios')->delete($usuario->imagen); // Borramos la imagen asociada.
        }
        $usuario->delete();
        Flash::error("Se ha realizado la eliminación del usuario: ".$usuario->name.".");        
        return redirect()->route('admin.usuarios.index');
    }
}
