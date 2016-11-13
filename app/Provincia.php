<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table =  "provincias";

    protected $fillable = ['nombre', 'pais_id']; 

    public function pais()   
    {
        return $this->belongsTo('App\Pais');
    }

    public function localidades()
    {
        return $this->hasMany('App\Localidad');
    }
}
