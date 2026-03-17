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
        if (Schema::hasTable('disponibilidades')) {
            Schema::drop('disponibilidades');
        }

        Schema::create('bloqueios_salas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sala_id')->constrained('salas')->cascadeOnDelete();
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fim')->nullable();
            $table->string('tipo')->default('dia_inteiro'); // dia_inteiro ou intervalo
            $table->text('motivo')->nullable();
            $table->boolean('ativo')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['sala_id', 'data_inicio', 'data_fim'], 'bloqueios_salas_periodo_idx');
            $table->index(['sala_id', 'ativo'], 'bloqueios_salas_ativo_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloqueios_salas');

        if (!Schema::hasTable('disponibilidades')) {
            Schema::create('disponibilidades', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sala_id')->constrained('salas');
                $table->date('data_inicio');
                $table->date('data_fim');
                $table->time('hora_inicio');
                $table->time('hora_fim');
                $table->timestamps();
            });
        }
    }
};
