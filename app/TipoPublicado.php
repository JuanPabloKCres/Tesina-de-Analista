<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPublicado extends Model
{
    protected $table =  "tipos_publicados";

    protected $fillable = ['nombre','estado','imagen'];
    

    public function productos_publicados()
    {
    	return $this->hasMany('App\ProductoPublicado');
    }

    
    public function imagen_tipo()
    {
        return $this->hasOne('App\TipoPublicado');
    }

    public function scopeSearchNombres($query, $nombre)
    {           
        if ($nombre == "-1")
            {
               return $query;
            } else {
               return $query->where('nombre', 'LIKE', $nombre);
            }
    }

    public function scopeSearchActivos($query)
    {
        return $query->where('estado', 'LIKE', 1);
    }

    public function scopeSearchValidos($query) {
        return $query->where('id', '>', 1);
    }
}
