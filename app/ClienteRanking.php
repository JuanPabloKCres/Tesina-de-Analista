<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteRanking extends Model
{
  protected $fillable = ['id','nombreCompleto', 'empresa', 'cantCompras', 'valorCompras'];
}
