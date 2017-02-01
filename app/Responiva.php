<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responiva extends Model
{
    protected $table = "responiva";
    protected $fillable = ['nombre','iva','factura'];

    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    public function config()
    {
        return $this->hasMany('App\Config');
    }

    /***************************************************************/
    public function scopeSearchValidos($query)
    {
        return $query->where('id',  '>', 1);
    }
}
