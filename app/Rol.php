<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'modulos'];

    public function users(){
        return $this->hasMany('App\User');
    }

/*
    public function scopeSearchModulos($query, $modulo)
    {
        return $query
            ->where('modulos', 'LIKE', $modulo);
    }
*/
    public function scopeSearchModulos($query, $modulo)
    {
        return $query->where('modulos', 'LIKE', '%'.$modulo.'%')->get();
    }
}
