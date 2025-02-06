<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{

    function reproduccion(){
        return $this->hasMany(Reproduccion::class, 'cliente_id')->get();
    }


    
}
