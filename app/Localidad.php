<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table =  "localidades";
    protected $fillable = ['nombre', 'provincia_id', 'cod_postal'];

    public static function localidades($id){     //este metodo me devuelve todas las localidades ingresandole el id de provincia
        return Localidad::where('provincia_id','=',$id)
        ->get();
    }

    public function provincia() 
    {
    	return $this->belongsTo('App\Provincia');
    }

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    public function proveedores()
    {
        return $this->hasMany('App\Proveedor');
    }

    public function config() 
    {
        return $this->hasOne('App\Config');
    }

}
