<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
 	protected $table =  "rubros";

    protected $fillable = ['nombre'];

    public function proveedores()
    {
        return $this->hasMany('App\Proveedor');
    }
}
