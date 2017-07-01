<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table =  "configs";
    protected $fillable = ['nombre', 'cuit', 'telefono', 'email', 'direccion', 'imagen', 'responiva_id', 'localidad_id', 'pago_cheque_cf', 'ventas_sin_stock', 'ingresar_precio_venta'];
    //*ingresar_precio_venta: si esta en 'true' el usuario pone a mano el valor de venta de articulo, si esta en 'false' el sistema busca el valor calculado para ese articulo en la pantalla de Tomar Pedidos

    public function localidad() 
    {
    	return $this->belongsTo('App\Localidad');
    }
    public function responiva()
    {
        return $this->belongsTo('App\Responiva');
    }
}
