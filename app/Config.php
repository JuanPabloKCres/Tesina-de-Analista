<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table =  "configs";

    protected $fillable = ['nombre', 'cuit', 'telefono', 'email', 'direccion', 'imagen', 'localidad_id'];

    public function localidad() 
    {
    	return $this->belongsTo('App\Localidad');
    }
}
