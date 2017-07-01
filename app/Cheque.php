<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model {

    protected $table = "cheques";
    protected $fillable = ['nro_serie', 'monto', 'cliente_id', 'fecha_emision', 'fecha_cobro', 'banco_id', 'sucursal',
                            'cobrado','usuario_cobro_id'];

    public function cliente() {
        return $this->belongsTo('App\Cliente');
    }

    public function cuentacorriente() {
        return $this->belongsTo('App\CuentaCorriente');
    }

    public function venta() {
        return $this->belongsTo('App\Venta');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function banco() {
        return $this->belongsTo('App\Banco');
    }

    public static function sinCobrar($cuentacorriente){
        $total_x_cobrar = 0;
        $cheques = Cheque::where('cliente_id',$cuentacorriente->cliente->id)->get();
        foreach($cheques as $cheque){
            if($cheque->cobrado == 0){
                $total_x_cobrar = $total_x_cobrar + $cheque->monto;
            }
        }
        return $total_x_cobrar;
    }

    public static function totalDineroChequesSinCobrar(){
        $total_x_cobrar = 0;
        $cheques = Cheque::where('cobrado',0)->get();
        foreach($cheques as $cheque){
            $total_x_cobrar = $total_x_cobrar + $cheque->monto;
        }
        return $total_x_cobrar;
    }

    /*     * ****************************************************************************************************** */

}
