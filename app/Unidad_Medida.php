<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad_Medida extends Model
{
    protected $table =  "unidades_medidas";
    protected $fillable = ['unidad', 'detalle'];

    public function insumos()
    {
        return $this->hasMany('App\Insumo');
    }

    /***************************************************************/
    public function scopeSearchValidos($query)
    {
        return $query->where('id',  '>', 1);
    }
}
