<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table =  "insumos";
    protected $fillable = ['nombre', 'unidad_medida', 'stock','stockMinimo', 'costo', 'descripcion', 'proveedor_id'];

    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }

    public function insumos_compra()
    {
        return $this->hasMany('App\InsumoCompra');
    }

    public function insumos_articulo()
    {
        return $this->hasMany('App\InsumoArticulo');
    }

    public function stockSuficiente($cantidadSolicitada)
    {
        $existencia = false;
        if ($this->stock >= $cantidadSolicitada) {
            $existencia = true;
        }
        return $existencia;
    }

    public function descontarStock($cant)
    {
        $this->stock = $this->stock - $cant;
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

    public function scopeSearchProveedor($query, $idproveedor)
    {
        if ($idproveedor == "-1")
        {
            return $query;
        } else {
            return $query->where('proveedor_id', 'LIKE', $idproveedor);
        }
    }

    public function scopeSearchActivos($query)
    {
        return $query->where('estado', 'LIKE', 1);
    }

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
}
