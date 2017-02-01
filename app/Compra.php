<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table =  "compras";
    protected $fillable = ['concepto', 'fecha_pedidoCompra','hora_pedidoCompra', 'fecha_compra','hora_compra', 'confirmado', 'pagado', 'recibido', 'userCompra_id', 'importe_insumos', 'importe_costo_envio', 'importe'];

    public function usuarioCompra()
    {
        return $this->belongsTo('App\User', 'userCompra_id');
    }

    public function insumos_compras()
    {
        return $this->hasMany('App\InsumoCompra');
    }

    public function proveedor()
    {
        return $this->belongsTo('App\Unidad_Medida');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function importe()   //copiado de Venta.php, todavia falta revisarlo
    {
        $total = 0;
        foreach ($this->insumos_compras as $ic) {
            $total = $total + $ic->importe;
        }
        //$total = $total + $total * $this->iva / 100;
        return $total;
    }

    public function cantidadInsumos()
    {
        $total = 0;
        foreach ($this->insumos_compras as $ic) {
            $total = $total + $ic->cantidad;
        }
        return $total;
    }

    /****************************** Metodos de Busqueda *****************************/
    public function scopeSearchPagado($query, $valor)
    {
        return $query->where('pagado', 'LIKE', $valor);
    }

    public function scopeSearchRecibido($query, $valor)
    {
        return $query->where('recibido', 'LIKE', $valor);
    }
}
