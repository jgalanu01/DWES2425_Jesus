<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    function libro(){
        return $this->belongsTo(Libro::class);
    }
}
