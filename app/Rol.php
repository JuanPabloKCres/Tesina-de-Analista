<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'nivel_acceso', 'modulos'];


    public function users(){
        return $this->hasMany('App\Users');
    }
}
