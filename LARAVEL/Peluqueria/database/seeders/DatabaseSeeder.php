<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('servicios')->insert([
            'descripcion' => 'Corte caballero',
            'precio'=>7.5

        ]);
        DB::table('servicios')->insert([
            'descripcion' => 'Lavado',
            'precio'=>3

        ]);
        DB::table('servicios')->insert([
            'descripcion' => 'Corte melena corta',
            'precio'=>10

        ]);
        DB::table('servicios')->insert([
            'descripcion' => 'Corte Barba',
            'precio'=>5

        ]);
    }
}
