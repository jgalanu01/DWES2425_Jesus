<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilotosS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pilotos')->insert(['nombre'=>'Fernando Alonso','nacionalidad'=>'España','escuderia'=>'Aston Martin']);
        DB::table('pilotos')->insert(['nombre'=>'Carlos Sainz','nacionalidad'=>'España','escuderia'=>'Williams']);
        DB::table('pilotos')->insert(['nombre'=>'Lando Norris','nacionalidad'=>'Británico','escuderia'=>'Mclaren']);
    }
}
