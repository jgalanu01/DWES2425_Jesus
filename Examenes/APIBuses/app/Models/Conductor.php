<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    function Billete(){
        return $this->hasMany(Billete::class)->get();
    }
}
