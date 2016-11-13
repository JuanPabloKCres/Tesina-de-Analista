<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloRanking extends Model
{
      protected $fillable = ['id', 'nombre', 'cantidad', 'importe'];
}
