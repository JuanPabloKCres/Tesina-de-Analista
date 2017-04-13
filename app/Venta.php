<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table =  "ventas";
    protected $fillable = ['fecha_pedido', 'hora_pedido', 'fecha_entrega_estimada', 'fecha_venta', 'hora_venta',
                            'fecha_facturacion','hora_facturacion', 'nro_cae', 'nro_facturero',
                            'pagado', 'entregado', 'senado', 'forma_pago', 'cheque_id', 'userPedido_id', 'userVenta_id', 'cliente_id'];
    //si la venta tiene nro_cae o nro_facturero (papel) el pago total ha sido facturado

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

    public function cheque()
    {
        return $this->belongsTo('App\Cheque');
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

    public function importeConIvaIncluido()
    {
        $total = 0;
        foreach ($this->articulos_ventas as $av) {
            $total = $total + $av->importe;
        }
        $total = $total + $total;
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

    public function scopeSearchSeDebenRetitarHoy($query)
    {
        $array_fecha = getdate();
        $año = $array_fecha['year'];
        $mes = $array_fecha['mon'];
        $dia = $array_fecha['mday'];

        if(strlen ($mes)==1){                       #si mes tiene un digito anteponer un 0 al mes
            if(strlen ($dia)==1){                       #si dia tambien tiene un digito anteponer un 0 al dia
                $fecha_hoy = $año.'-0'.$mes.'-0'.$dia;
            }else{
                $fecha_hoy = $año.'-0'.$mes.'-'.$dia;
            }
        }else{
            if(strlen ($dia)==1){                       #si dia tiene un digito anteponer un 0 al dia
                $fecha_hoy = $año.'-'.$mes.'-0'.$dia;
            }else{
                $fecha_hoy = $año.'-'.$mes.'-'.$dia;
            }
        }

        return $query->where('fecha_entrega_estimada', 'LIKE', $fecha_hoy);
    }


    public function scopeSearchMayorFechaInicio($query, $fechaInicio)
    {
      echo($query->where('fecha_venta','bet', $fechaInicio)) ;      //tenia dd en vez de echo
    }

    public function scopeSearchMenorFechaFin($query, $fechaFin)
    {
      return $query->where('fecha_venta','<', $fechaFin);
    }
}
