<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billete extends Model
{
    function Conductor(){
        return $this->belongsTo(Conductor::class);
    }

    function Linea(){
        return $this->belongsTo(Linea::class);
    }
}
