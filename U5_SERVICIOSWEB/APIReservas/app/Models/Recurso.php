<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    function Reserva(){
        return $this->hasMany(Reserva::class)->get();
    }
}
