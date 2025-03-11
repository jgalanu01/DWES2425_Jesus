<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    function obtenerPrestamos(){
        return $this->hasMany(Prestamo::class)->get();
    }
}
