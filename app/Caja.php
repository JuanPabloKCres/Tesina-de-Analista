<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
	protected $table =  "cajas";

    protected $fillable = ['fecha_apertura', 'hora_apertura', 'saldo_inicial', 'saldo', 'saldo_cierre', 'fecha_cierre', 'hora_cierre', 'cerrado', 'userApertura_id', 'userCierre_id'];
    
    public function usuarioApertura()   
    {
        return $this->belongsTo('App\User', 'userApertura_id');
    }

    public function usuarioCierre()   
    {
        return $this->belongsTo('App\User', 'userCierre_id');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function totalEntrada()
    {
        $total = 0;
        foreach ($this->movimientos as $movimiento) {
            if ($movimiento->tipo == 'entrada'){
                $total = $total + $movimiento->monto;
            } 
        }
         return $total;
    }

    public function totalSalida()
    {
        $total = 0;
        foreach ($this->movimientos as $movimiento) {
            if ($movimiento->tipo == 'salida'){
                $total = $total + $movimiento->monto;               
            } 
        }
        return $total;
    }

    public function totalMovimientos()
    {
        $total = $this->saldo_inicial;
        foreach ($this->movimientos as $movimiento) {
            if ($movimiento->tipo === 'salida'){                
                $total = $total - $movimiento->monto;
            } else {
                $total = $total + $movimiento->monto; //**!!Atencion!!! no se suman las señas. Ver PedidosController.php
            }
        }
        return $total;
    }

}
