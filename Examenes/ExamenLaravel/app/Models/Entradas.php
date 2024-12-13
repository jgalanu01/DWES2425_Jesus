<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entradas extends Model
{
    function concierto(){
        return $this->belongsTo(Conciertos::class);
    }
}
