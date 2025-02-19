<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    function servicios(){
        return $this->hasMany(Servicio::class)->get();
    }
}
