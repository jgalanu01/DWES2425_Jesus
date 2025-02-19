<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ConductorsS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void


    {

        DB::table('conductors')->insert([
            'nombre' => 'Jesus',
            'dni' => '76065434L',
            
        ]);
        DB::table('conductors')->insert([
            'nombre' => 'Andres',
            'dni' => '56984387H',
            
        ]);
        DB::table('conductors')->insert([

            'nombre' => 'Ivan',
            'dni' => '94954881P',
            
        ]);
    }
}
