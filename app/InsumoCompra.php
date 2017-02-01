<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsumoCompra extends Model
{
    protected $table =  "insumos_compras";

    protected $fillable = ['cantidad', 'proveedor_id','precio_unitario', 'importe_insumo', 'insumo_id', 'compra_id'];

    public function insumo()
    {
        return $this->belongsTo('App\Insumo');
    }

    public function compra()
    {
        return $this->belongsTo('App\Compra');
    }

    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }


    /******************************************************************************/
    public function scopeSearchProveedor($query, $idproveedor)
    {
        if ($idproveedor == "-1")
        {
            return $query;
        } else {
            return $query->where('proveedor_id', 'LIKE', $idproveedor);
        }
    }
}
