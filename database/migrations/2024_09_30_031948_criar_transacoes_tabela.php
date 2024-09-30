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
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('reserva_id')->constrained('reservas'); // Relaciona com a reserva feita
            $table->string('metodo_pagamento'); // Cartão de crédito, Pix, etc.
            $table->decimal('valor', 10, 2); // Valor da transação
            $table->string('status')->default('pendente'); // Status: pendente, pago, cancelado
            $table->timestamps();
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
