<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{
    function obtenerVuelta(){
        return $this->hasMany(Vuelta::class)->get();
    }
}
