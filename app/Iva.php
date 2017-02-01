<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    protected $table = "ivas";
    protected $fillable = ['iva'];

    public function articulos()
    {
        return $this->hasMany('App\Articulo');
    }

    /***************************************************************/
    public function scopeSearchValidos($query)
    {
        return $query->where('id',  '>', 1);
    }
}
