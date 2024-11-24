<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarReservasTabela extends Migration
{
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('sala_id')->constrained('salas');
            $table->date('data_reserva'); // Data específica da reserva
            $table->time('hora_inicio'); // Hora de início obrigatória
            $table->time('hora_fim'); // Hora de fim obrigatória
            $table->string('status')->default('ativa'); // Status da reserva
            $table->timestamps();
        
            // Índice único para garantir uma única reserva por sala, data e hora
            $table->unique(['sala_id', 'data_reserva', 'hora_inicio', 'hora_fim'], 'reserva_unica');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
