<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = "colores";

    protected $fillable = ['nombre', 'codigo'];

    public function insumos()
    {
        return $this->hasMany('App\Insumo');
    }

    /*************************************************************/

    public function scopeSearchValidos($query)
    {
        return $query->where('id',  '>', 1);
    }
}
