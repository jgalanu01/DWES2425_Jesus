<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    // Relación con cita
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    // Relación con servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
