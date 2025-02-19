<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billete extends Model
{
    function servicios(){
        return $this->belongsTo(Servicio::class);
    }
}
