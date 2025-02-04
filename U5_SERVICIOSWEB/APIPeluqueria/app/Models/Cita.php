<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    // Relación con detalle_citas
    public function detalleCitas()
    {
        return $this->hasMany(DetalleCita::class);
    }



    // Método para obtener el total de la cita
    public function getTotalAttribute()
    {
        return $this->detalleCitas->sum('precio');
    }
}
