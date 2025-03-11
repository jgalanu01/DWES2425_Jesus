<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    //
    function reproduccions(){
        return $this->hasMany(Reproduccion::class)->get();
    }
}
