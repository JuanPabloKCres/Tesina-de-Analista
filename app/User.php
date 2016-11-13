<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'imagen', 'password', 'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
