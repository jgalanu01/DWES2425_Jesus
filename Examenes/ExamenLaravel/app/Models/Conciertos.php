<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conciertos extends Model
{
   function obtenerEntradas(){
    return $this->hasMany(Entradas::class)->get();
   }
}
