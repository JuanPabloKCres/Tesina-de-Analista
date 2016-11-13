<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Tipo extends Model
{
    protected $table =  "tipos";
    protected $fillable = ['nombre','descripcion'];


    public function articulos()
    {
        return $this->hasMany('App\Articulo');
    }

    /******************************************************/

    public function scopeSearchNombres($query, $nombre)
    {
        if ($nombre == "-1")
        {
            return $query;
        } else {
            return $query->where('nombre', 'LIKE', $nombre);
        }

    }

    public function scopeSearchValidos($query)
    {
        return $query->where('id',  '>', 1);
    }

}
