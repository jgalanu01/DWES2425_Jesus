<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reproduccion extends Model
{
    function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    function servicio(){
        return $this->belongsTo(Contenido::class);
    }
}
