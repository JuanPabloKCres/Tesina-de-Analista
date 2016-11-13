<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gnsolucion extends Model
{
	protected $table =  "configuraciones";

    protected $fillable = ['nombre', 'localidad_id','direccion', 'imagen', 'email', 'telefono', 'cuit'];
    
}
