<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table =  "ventas";

    protected $fillable = ['fecha_pedido', 'hora_pedido', 'fecha_venta', 'hora_venta', 'iva','pagado', 'entregado', 'senado', 'userPedido_id', 'userVenta_id', 'cliente_id'];

    public function usuarioPedido()
    {
        return $this->belongsTo('App\User', 'userPedido_id');
    }

    public function usuarioVenta()
    {
        return $this->belongsTo('App\User', 'userVenta_id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function articulos_ventas()
    {
        return $this->hasMany('App\ArticuloVenta');
    }

    public function movimientos()
	  {
    	 return $this->hasMany('App\Movimiento');
    }

    public function importe()
	  {
      $total = 0;
      foreach ($this->articulos_ventas as $av) {
          $total = $total + $av->importe;
      }
      $total = $total + $total * $this->iva / 100; 
       return $total;
    }

    public function cantidadArticulos()
    {
      $total = 0;
      foreach ($this->articulos_ventas as $av) {
          $total = $total + $av->cantidad;
      }
       return $total;
    }

    public function scopeSearchPagado($query, $valor)
    {
     return $query->where('pagado', 'LIKE', $valor);
    }

    public function scopeSearchEntregado($query, $valor)
    {
      return $query->where('entregado', 'LIKE', $valor);
    }

    public function scopeSearchMayorFechaInicio($query, $fechaInicio)
    {
      dd($query->where('fecha_venta','bet', $fechaInicio)) ;
    }

    public function scopeSearchMenorFechaFin($query, $fechaFin)
    {
      return $query->where('fecha_venta','<', $fechaFin);
    }
}
