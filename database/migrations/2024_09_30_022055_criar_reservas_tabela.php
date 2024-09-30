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
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('status')->default('ativa'); // Status da reserva
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
