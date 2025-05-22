<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideojuegosS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videojuegos')->insert(['nombre'=>'The last of us','plataforma'=>'Play Station','precio'=>70,'stock'=>1000]);
        DB::table('videojuegos')->insert(['nombre'=>'GtaVI','plataforma'=>'Play Station','precio'=>100,'stock'=>10000]);
        DB::table('videojuegos')->insert(['nombre'=>'Life is Strange','plataforma'=>'PC','precio'=>25,'stock'=>200]);
    }
}
