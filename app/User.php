<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table =  "users";
    protected $fillable = ['name','nivel_acceso_id','email', 'imagen', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function auditorias(){
        return $this->hasMany('App\Auditoria');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function cierres()
    {
        return $this->hasMany('App\Caja', 'foreign_key', 'userCierre_id');
    }

    public function aperturas()
    {
        return $this->hasMany('App\Caja', 'foreign_key', 'userApertura_id');
    }
}
