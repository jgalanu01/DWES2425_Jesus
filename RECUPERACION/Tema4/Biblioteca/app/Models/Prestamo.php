<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    function obtenerLibro(){
        return $this->belongsTo(Libro::class);
    }
}
