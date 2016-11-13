<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloVenta extends Model
{
	protected $table =  "articulos_ventas";

    protected $fillable = ['cantidad', 'importe', 'precio_unitario', 'articulo_id', 'venta_id'];

    public function articulo()
    {
        return $this->belongsTo('App\Articulo');
    }

    public function venta()
    {
        return $this->belongsTo('App\Venta');
    }


}
