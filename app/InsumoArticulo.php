<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsumoArticulo extends Model
{
    protected $table =  "insumos_articulos";

    protected $fillable = ['cantidad', 'precio_unitario', 'importe_insumo', 'insumo_id', 'articulo_id'];

    public function insumo()
    {
        return $this->belongsTo('App\Insumo');
    }

    public function articulo()
    {
        return $this->belongsTo('App\Articulo');
    }


    /******************************************************************************/

    public function scopeSearchInsumosArticulo($query, $idarticulo)
    {
        if ($idarticulo == "-1")
        {
            return $query;
        } else {
            return $query->where('articulo_id', 'LIKE', $idarticulo);
        }
    }
}
