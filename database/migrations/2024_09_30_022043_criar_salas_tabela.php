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
            $table->unsignedBigInteger('endereco_id')->nullable()->change();
            $table->decimal('valor', 8, 2)->nullable(); // Definir o valor da sala
            $table->string('status')->default('disponivel'); // Status da sala
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('salas');
    }
}

