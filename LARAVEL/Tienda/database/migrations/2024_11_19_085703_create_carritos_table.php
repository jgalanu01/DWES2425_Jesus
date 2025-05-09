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
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('producto_id')
            ->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')
            ->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->float('precioU');
            $table->integer ('cantidad');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
