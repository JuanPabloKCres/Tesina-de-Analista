<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model {

    protected $table = "cheques";
    protected $fillable = ['nro_serie', 'monto', 'cliente_id', 'fecha_emision', 'fecha_cobro', 'banco_id', 'sucursal'];


    public function cliente() {
        return $this->belongsTo('App\Cliente');
    }

    public function venta() {
        return $this->belongsTo('App\Venta');
    }

    public function banco() {
        return $this->belongsTo('App\Banco');
    }

    /*     * ****************************************************************************************************** */

}
