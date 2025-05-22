<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    function servicio(){
        return $this->belongsTo(Servicio::class);
    }

    function citas(){

        return $this->belongsTo(Cita::class);

    }
}
