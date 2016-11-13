<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table =  "paises";

    protected $fillable = ['nombre'];

    public function provincias()
    {
        return $this->hasMany('App\Provincia');
    }
}
