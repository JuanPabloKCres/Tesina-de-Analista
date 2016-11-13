<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
	protected $table =  "movimientos";

    protected $fillable = ['concepto', 'caja_id', 'venta_id', 'monto', 'tipo', 'fecha', 'hora', 'user_id'];

    public function caja()   
    {
        return $this->belongsTo('App\Caja');
    }

    public function user()   
    {
        return $this->belongsTo('App\User');
    }

	public function ventas()
	{
    	 return $this->belongsTo('App\Venta');
	}  

}
