<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responiva extends Model
{
    protected $table = "responiva";

    protected $fillable = ['nombre','iva','factura','descripcion'];
    //el atributo 'descripcion' debe añadirse en 'migrations' de considerarse importante para el cliente

    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    /***************************************************************/
    public function scopeSearchValidos($query)
    {
        return $query->where('id',  '>', 1);
    }
}
