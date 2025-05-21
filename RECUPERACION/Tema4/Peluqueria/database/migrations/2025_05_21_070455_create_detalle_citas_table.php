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
        Schema::create('detalle_citas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('cita_id')->nullable(false)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('servicio_id')->nullable(false)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->double('precio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_citas');
    }
};
