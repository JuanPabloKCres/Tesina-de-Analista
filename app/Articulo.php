<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Articulo extends Model
{

	protected $table =  "articulos";
    protected $fillable = ['nombre','alto','ancho', 'tipo_id', 'talle_id', 'color_id' , 'cantidad_insumos', 'costo', 'margen','ganancia','iva_id','montoIva', 'precioVta','descripcion', 'estado', 'user_id'];


    public function articulos_venta()
    {
        return $this->hasMany('App\ArticuloVenta');
    }

    public function insumos_articulos()
    {
        return $this->hasMany('App\InsumoArticulo');
    }

    public function descontarStock($cant)
	{
	    $this->stock = $this->stock - $cant;
    }

    public function iva()
    {
        return $this->belongsTo('App\Iva');
    }

/******************************************************************************************************/
    public function scopeSearchNombres($query, $nombre)
    {
        if ($nombre == "-1")
        {
            return $query;
        } else {
            return $query->where('nombre', 'LIKE', $nombre);
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

    public function scopeSearchTipo($query, $idtipo)
    {
        if ($idtipo == "-1")
        {
            return $query;
        } else {
            return $query->where('tipo_id', 'LIKE', $idtipo);
        }
    }

    /*
    public function scopeSearchMaterial($query, $idmaterial)
    {
        if ($idmaterial == "-1")
        {
            return $query;
        } else {
            return $query->where('material_id', 'LIKE', $idmaterial);
        }
    }

    public function scopeSearchTalle($query, $idtalle)
    {
        if ($idtalle == "-1")
        {
            return $query;
        } else {
            return $query->where('talle_id', 'LIKE', $idtalle);
        }
    }
    */

}
