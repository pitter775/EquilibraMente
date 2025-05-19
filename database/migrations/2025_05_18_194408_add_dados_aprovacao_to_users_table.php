<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('documento_tipo')->nullable()->after('email'); // ou outro campo que quiser
            $table->string('documento_identidade')->nullable()->after('documento_tipo');
            $table->string('status_aprovacao')->default('pendente')->after('documento_identidade');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['documento_tipo', 'documento_identidade', 'status_aprovacao']);
        });
    }
    
};
