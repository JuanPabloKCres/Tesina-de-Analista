<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table =  "insumos";
    protected $fillable = ['nombre', 'unidad_medida_id', 'alto','ancho', 'stock','stockMinimo', 'costo','costo_anterior', 'descripcion', 'talle_id', 'color_id', 'material_id'];


    public function insumos_compra()
    {
        return $this->hasMany('App\InsumoCompra');
    }

    public function insumos_articulo()
    {
        return $this->hasMany('App\InsumoArticulo');
    }

    public function unidad_medida()
    {
        return $this->belongsTo('App\Unidad_Medida');
    }
    public function color()
    {
        return $this->belongsTo('App\Color');
    }
    public function talle()
    {
        return $this->belongsTo('App\Talle');
    }

    public function stockSuficiente($cantidadSolicitada)
    {
        $existencia = false;
        if ($this->stock >= $cantidadSolicitada) {
            $existencia = true;
        }
        return $existencia;
    }

    //se llama cuando se toma un pedido-venta
    public function descontarStock($cant)
    {
        $this->stock = $this->stock - $cant;
    }

    /* ***** se llaman cuando se compran insumos******/
    public function incrementarStock($cant)
    {
        $this->stock = $this->stock + $cant;
    }

    public function actualizarCosto($costo_nvo)
    {
        $this->costo = $costo_nvo;
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

    public function scopeSearchMaterial($query, $idmaterial)
    {
        if ($idmaterial == "-1")
        {
            return $query;
        } else {
            return $query->where('material_id', 'LIKE', $idmaterial);
        }
    }

    public function scopeSearchUnidad($query, $idunidad)
    {
        if ($idunidad == "-1")
        {
            return $query;
        } else {
            return $query->where('unidad_medida_id', 'LIKE', $idunidad);
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

    public function scopeSearchTipo($query, $idtipo)
    {
        if ($idtipo == "-1")
        {
            return $query;
        } else {
            return $query->where('tipo_id', 'LIKE', $idtipo);
        }
    }
}
