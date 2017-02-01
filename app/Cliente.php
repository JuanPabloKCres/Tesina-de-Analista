<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $table = "clientes";
    protected $fillable = ['nombre', 'apellido', 'empresa', 'responiva_id', 'cuit', 'dni', 'descripcion', 'telefono', 'email', 'localidad_id', 'direccion'];

    public function ventas() {
        return $this->hasMany('App\Venta');
    }

    public function cheques() {
        return $this->hasMany('App\Cheque');
    }

    public function localidad() {
        return $this->belongsTo('App\Localidad');
    }

    public function responiva() {
        return $this->belongsTo('App\Responiva');
    }

    /*     * ****************************************************************************************************** */

    /*
    public function ultimaCompra() {
        $historialVentas = [];
        foreach ($this->ventas as $venta) {            
            if (($venta->pagado) && ($venta->entregado)) {
                array_push($historialVentas, $venta);               
            }
        }
        return $historialVentas[count($historialVentas)-1];
    }
    */

    public function importeVentasRealizadas() {
        $total = 0;
        foreach ($this->ventas as $venta) {
            if (($venta->pagado) && ($venta->entregado)) {
                $total = $total + $venta->importe();
            }
        }
        return $total;
    }

    public function scopeSearchResponiva($query, $idresponIva) {
        if ($idresponIva == "-1") {
            return $query;
        } else {
            return $query->where('responIva_id', 'LIKE', $idresponIva);
        }
    }

    public function scopeSearchValidos($query) {
        return $query->where('id', '>', 1);
    }

    public function scopeSearchNombres($query, $name) {
        if ($name == "-1") {
            return $query;
        } else {
            return $query->where('nombre', 'LIKE', $name);
        }
    }


    public function scopeSearchOrigen($query, $idOrigen) {
        if ($idOrigen == "-1") {
            return $query;
        } else {
            return $query->where('localidad_id', 'LIKE', $idOrigen);
        }
    }

}
