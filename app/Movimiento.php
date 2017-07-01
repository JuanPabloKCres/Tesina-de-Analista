<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
	protected $table =  "movimientos";

    protected $fillable = ['concepto', 'caja_id', 'ccorriente_id','cuenta_corriente_id', 'venta_id', 'compra_id', 'monto', 'tipo', 'forma', 'fecha', 'hora', 'user_id'];
    #forma: {caja / cuentacorriente }

    public function caja()   
    {
        return $this->belongsTo('App\Caja');
    }

    public function ccorriente()
    {
        return $this->belongsTo('App\CuentaCorriente');
    }

    public function user()   
    {
        return $this->belongsTo('App\User');
    }

	public function venta()
	{
    	 return $this->belongsTo('App\Venta');
	}

    public function compras()
    {
        return $this->belongsTo('App\Compra');
    }

}
