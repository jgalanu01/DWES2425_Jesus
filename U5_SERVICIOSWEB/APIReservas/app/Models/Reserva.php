<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    
    function Recurso(){
        return $this->belongsTo(Recurso::class);
    }
}
