<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoPublicado extends Model
{
    protected $table =  "productos_publicados";

    protected $fillable = ['nombre', 'descripcion', 'estado', 'tipo_publicado_id', 'imagen'];


    public function tipo()
    {
    	return $this->belongsTo('App\TipoPublicado');
    }


    public function logo_producto()
    {
        return $this->hasOne('App\ProductoPublicado');
    }

    public function scopeSearchNombres($query, $name)
    {           
        if ($name == "-1")
            {
               return $query;
            } else {                
               return $query->where('nombre', 'LIKE', $name);
            } 
        
    }

    public function scopeSearchTipos($query, $idTipo)   //el bardo en ProductoParaFrontController
    {           
        if ($idTipo == "-1")
            {
               return $query;
            } else {
               return $query->where('tipo_publicado_id', 'LIKE', $idTipo);
            } 
    }

    public function scopeSearchEstado($query, $estado)
    {           
        if ($estado == "-1")
            {
               return $query;
            } else {
               return $query->where('estado', 'LIKE', $estado);
            } 
    }

    public function scopeSearchActivos($query)
    {
        return $query->where('estado', 'LIKE', 1);
    }

    /*
    public function scopeSearchTipo($query, $idTipo)
    {           
        if ($idTipo == "-1")
            {
               return $query;
            } else {
               return $query->where('tipo_publicado_id', 'LIKE', $idTipo);
            } 
    }
    */

}
