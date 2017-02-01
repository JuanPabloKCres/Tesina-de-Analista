<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talle extends Model
{
    protected $table =  "talles";
    protected $fillable = ['talle'];

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
