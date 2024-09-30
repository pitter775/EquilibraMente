<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarSalasTabela extends Migration
{
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->foreignId('endereco_id')->constrained('enderecos');
            $table->string('foto')->nullable();
            $table->string('status')->default('disponivel'); // Status da sala
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salas');
    }
}

