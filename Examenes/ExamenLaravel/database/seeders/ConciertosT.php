<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConciertosT extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conciertos')->insert([
            'titulo'=>'Canta Juegos',
            'fecha'=>'2025/01/25',
            'aforo'=>200,
            'precioEntrada'=>10.50
        ]);
        DB::table('conciertos')->insert([
            'titulo'=>'Dj Noon',
            'fecha'=>'2025/03/03',
            'aforo'=>100,
            'precioEntrada'=>12.50
        ]);
        DB::table('conciertos')->insert([
            'titulo'=>'Mucho más que tres - Abigail',
            'fecha'=>'2025/02/03',
            'aforo'=>170,
            'precioEntrada'=>21.50
        ]);
    }
}
