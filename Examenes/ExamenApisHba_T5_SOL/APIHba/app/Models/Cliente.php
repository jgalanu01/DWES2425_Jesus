<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    function reproducciones(){
        return $this->hasMany(Reproduccion::class)->get();
    }
}
