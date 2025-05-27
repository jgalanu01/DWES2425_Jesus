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
        Schema::create('vueltas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('piloto_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->integer('tiempo')->nullable(false);
            $table->boolean('anulada')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vueltas');
    }
};
