<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conciertos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo')->unique();
            $table->date('fecha');
            $table->integer('aforo');
            $table->integer('precioEntrada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conciertos');
    }
};
