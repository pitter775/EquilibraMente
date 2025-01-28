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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('sala_id');
            $table->string('pagbank_order_id')->nullable(); // ID do pedido no PagBank
            $table->string('reference_id')->nullable(); // ID de referência da transação
            $table->decimal('valor', 10, 2);
            $table->string('status')->default('PENDING'); // Status inicial da transação
            $table->json('detalhes')->nullable(); // Dados completos retornados pelo PagBank
            $table->timestamps();
    
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('sala_id')->references('id')->on('salas');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
