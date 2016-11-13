<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talle extends Model
{
    protected $table =  "talles";
    protected $fillable = ['talle', 'alto', 'ancho'];

    public function articulos()
    {
        return $this->hasMany('App\Articulo');
    }

    /***************************************************************/
    public function scopeSearchValidos($query)
    {
        return $query->where('id',  '>', 1);
    }
}
