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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tipo_usuario')->default('cliente'); // cliente ou admin
            $table->string('cpf')->nullable(); // CPF do usuário
            $table->string('sexo')->nullable(); // Sexo do usuário
            $table->integer('idade')->nullable(); // Idade do usuário
            $table->string('registro_profissional')->nullable(); // Número do registro profissional
            $table->string('tipo_registro_profissional')->nullable(); // Tipo do registro (CRM, CRP, etc.)
            $table->string('photo')->nullable(); // URL da foto do usuário
            $table->string('telefone')->nullable(); // Telefone com DDD
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos')->onDelete('set null');
            $table->string('status')->default('ativo'); // status: 'ativo' ou 'inativo'
            $table->boolean('cadastro_completo')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
