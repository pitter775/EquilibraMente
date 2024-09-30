<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarDisponibilidadesTabela extends Migration
{
    public function up()
    {
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

    public function down()
    {
        Schema::dropIfExists('disponibilidades');
    }
}
