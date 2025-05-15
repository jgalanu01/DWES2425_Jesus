<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    function conductors(){
        return $this->belongsTo(Conductor::class);
    }

    function billetes(){
        return $this->hasMany(Billete::class)->get();
    }
}
