<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

//Crear resource si no está con php artisan make:resource (nombre en si singular y primera en mayusc +R)


class BilleteR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombreLinea' => $this->linea->nombre,
            'nombreConductor' => $this->conductor->nombreApe,
            'tipoBillete'=>$this->tipo,
            'precioBillete'=>$this->precio
        ];
    }
}
