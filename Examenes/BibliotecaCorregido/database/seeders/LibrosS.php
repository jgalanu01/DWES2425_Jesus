<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrosS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('libros')->insert([
            'titulo'=>'Don quijote',
            'numEjemplares'=>1
        ]);
        DB::table('libros')->insert([
            'titulo'=>'El niño del pijama de rayas',
            'numEjemplares'=>6
        ]);
        DB::table('libros')->insert([
            'titulo'=>'Charlie y la fabrica de choco',
            'numEjemplares'=>8
        ]);
        DB::table('libros')->insert([
            'titulo'=>'El rey leon',
            'numEjemplares'=>12
        ]);
    }
}
