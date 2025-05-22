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
            'titulo'=>'Don Quijote',
            'numEjemplares'=>'10'
        ]);
        
        DB::table('libros')->insert([
            'titulo'=>'La casa de chocolate',
            'numEjemplares'=>'20'
        ]);

        DB::table('libros')->insert([
            'titulo'=>'La ceninicienta',
            'numEjemplares'=>'15'
        ]);
        
    }
}
