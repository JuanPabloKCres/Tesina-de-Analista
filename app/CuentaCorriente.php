<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaCorriente extends Model
{
	protected $table =  "ccorrientes";

    protected $fillable = ['cliente_id','debe', 'haber','saldo', 'fecha_apertura', 'hora_apertura', 'activa',
        'userApertura_id',   'saldo_inicial', 'saldo_cierre', 'fecha_cierre', 'hora_cierre', 'cerrado', 'userApertura_id', 'userCierre_id'];
    
    public function usuarioApertura()   
    {
        return $this->belongsTo('App\User', 'userApertura_id');
    }

    public static function salidas()
    {
        $movimientos = Movimiento::with('caja_id',null)->with('tipo',"entrada");
        $total = 0;
        foreach ($movimientos as $movimiento) {
            $total = $total + $movimiento->monto;
        }
        return $total;
    }

    public static function sumatoriaDebesCuentasCorrientes(){   /**Debes de la Gráfica en cuentas corrientes */
    $deudas_x_cobrar = 0;
        $cuentascorrientes = CuentaCorriente::all();
        foreach($cuentascorrientes as $cc){
            if($cc->activa == 1){
                foreach ($cc->movimientos as $movimiento) {
                    if ( ($movimiento->tipo == 'salida') && ($movimiento->forma == 'CC') ){
                        $deudas_x_cobrar = $deudas_x_cobrar + $movimiento->monto;
                    }
                }
            }
        }
        return $deudas_x_cobrar;
    }

    public static function sumatoriaHaberesCuentasCorrientes(){   /**Haberes de la Gráfica en cuentas corrientes */
        $deudas_x_cobrar = 0;
        $cuentascorrientes = CuentaCorriente::all();
        foreach($cuentascorrientes as $cc){
            if($cc->activa == 1){
                foreach ($cc->movimientos as $movimiento) {
                    if ( ($movimiento->tipo == 'entrada') && ($movimiento->forma == 'CC') ){
                        $deudas_x_cobrar = $deudas_x_cobrar + $movimiento->monto;
                    }
                }
            }
        }
        return $deudas_x_cobrar;
    }

    public function usuarioCierre()   
    {
        return $this->belongsTo('App\User', 'userCierre_id');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function cheques()
    {
        return $this->hasMany('App\Cheque');
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

    public function haber_cc($cuentacorriente)  //haber de cc cliente
    {
        $total = 0;
        foreach ($cuentacorriente->movimientos as $movimiento) {
                if ( ($movimiento->tipo == 'entrada') && ($movimiento->forma == 'CC') ){
                    $total = $total + $movimiento->monto;
                }
        }
        return $total;
    }



    public function totalCheques()
    {
        $total = 0;
        foreach ($this->movimientos as $movimiento) {
            if ($movimiento->tipo == 'entrada' && $movimiento->forma == 'cheque'){
                $total = $total + $movimiento->monto;
            }
        }
        return $total;
    }



    public function debe_cc()   /**calcula deuda en una CuentaCorriente */
    {
        $total = 0;
        foreach ($this->movimientos as $movimiento) {
            if ( ($movimiento->tipo == 'salida') && ($movimiento->forma == 'CC') ){
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
