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
        Schema::create('imagens_salas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sala_id'); // Chave estrangeira para a tabela salas
            $table->string('path'); // Caminho da imagem no armazenamento
            $table->boolean('principal')->default(false); // Marcar se é a imagem principal
            $table->timestamps();
        
            // Definir a chave estrangeira e relacionar com a tabela de salas
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagens_salas');
    }
};
