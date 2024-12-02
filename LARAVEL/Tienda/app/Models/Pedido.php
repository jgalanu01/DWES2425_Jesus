<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //Relacion 1:1 1 registro de pedido tiene un solo usuario

    function usuario(){
        return $this->belongsTo(User::class);
    }

    //Relacion 1:1 1 registro de pedido tiene un solo producto

    function producto(){
        return $this->belongsTo(Producto::class);
    }
}
