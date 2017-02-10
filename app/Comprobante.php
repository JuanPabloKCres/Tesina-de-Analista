<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table =  "comprobante";
    protected $fillable = ['cliente_id','user_id','comprobante'];

    public function user()
    {
        return $this->belingsTo('App\User');
    }

    public function cliente()
    {
        return $this->belingsTo('App\Cliente');
    }
}
