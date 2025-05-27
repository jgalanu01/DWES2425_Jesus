<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelta extends Model
{
    function obtenerPiloto(){
        return $this->belongsTo(Piloto::class);
    }
}
