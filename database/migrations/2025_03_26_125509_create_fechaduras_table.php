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
        Schema::create('fechaduras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sala_id');
            $table->string('tipo')->nullable(); // ex: "intelbras", "manual"
            $table->json('chaves')->nullable(); // se quiser guardar várias chaves
            $table->timestamps();
    
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fechaduras');
    }
};
