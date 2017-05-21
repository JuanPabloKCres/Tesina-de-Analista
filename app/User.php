<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table =  "users";
    protected $fillable = ['name','rol_id','email', 'imagen', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function auditorias(){
        return $this->hasMany('App\Auditoria');
    }

    public function comprobantes(){
        return $this->hasMany('App\Comprobante');
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

    public function aperturaCC()
    {
        return $this->hasMany('App\CuentaCorriente', 'foreign_key', 'userApertura_id');
    }

    public function scopeSearchRoles($query, $rol_id)
    {
        if ($rol_id == "-1")
        {
            return $query;
        } else {
            return $query->where('rol_id', 'LIKE', $rol_id);
        }
    }

    /*  Quitado el 15/03
    public function scopeSearchModulos($query, $modulo)
    {
        if ($modulo == "-1")
        {
            return $query;
        } else {
            return $query->where('modulos', 'LIKE', $modulo);
        }
    }
    */
}
