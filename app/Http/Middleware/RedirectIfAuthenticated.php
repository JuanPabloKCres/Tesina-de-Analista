<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfAuthenticated
{
    protected $auth;
    public function __construct(Guard $auth){
        $this->auth = $auth;
    }


    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            switch ($this->auth->user()->rol_id){
                case '1':
                    #Administrador
                    return redirect()->to('admin');
                    break;
                case '2':
                    #AdminWeb
                    return redirect()->to('tipos');
                    break;
                case '3':
                    return redirect()->to('clientes');
                    break;
            }


            return redirect('/');
        }

        return $next($request);
    }
}
