<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table =  "auditorias";
    protected $fillable = ['tabla', 'elemento_id', 'usuario_id', 'accion', 'dato_nuevo', 'dato_anterior'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /********************************************************************/

    /********************************************************************/
}
