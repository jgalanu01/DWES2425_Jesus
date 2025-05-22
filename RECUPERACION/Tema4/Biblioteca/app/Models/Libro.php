<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    function obtenerPrestamo(){
        return $this->hasMany(Prestamo::class)->get();
    }
}
