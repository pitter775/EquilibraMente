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
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transacao_id')->constrained('transacoes'); // Relaciona a nota à transação
            $table->string('numero_nota')->unique(); // Número da nota fiscal
            $table->string('chave_acesso')->unique(); // Chave de acesso da nota fiscal
            $table->decimal('valor', 10, 2); // Valor da nota fiscal
            $table->string('status')->default('pendente'); // Status: pendente, emitida, cancelada
            $table->date('data_emissao')->nullable(); // Data de emissão da nota
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_fiscais');
    }
};
