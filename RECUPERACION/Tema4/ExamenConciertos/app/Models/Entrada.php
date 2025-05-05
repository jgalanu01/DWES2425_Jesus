<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    function Concierto(){
        return $this->belongsTo(Concierto::class);
    }
}
