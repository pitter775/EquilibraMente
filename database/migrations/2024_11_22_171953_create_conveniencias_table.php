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
        Schema::create('conveniencias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('icone')->nullable(); // Para o nome do ícone
            $table->timestamps();
        });
    
        Schema::create('sala_conveniencias', function (Blueprint $table) {
            $table->foreignId('sala_id')->constrained()->cascadeOnDelete();
            $table->foreignId('conveniencia_id')->constrained('conveniencias')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sala_conveniencias'); // primeiro apaga a dependente
        Schema::dropIfExists('conveniencias');      // depois apaga a principal
    }
};
