<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table =  "bancos";
    protected $fillable = ['nombre'];

    public function cheques()
    {
        return $this->hasMany('App\Cheque');
    }
}
