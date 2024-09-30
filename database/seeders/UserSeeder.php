<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Criar um cliente
        User::create([
            'name' => 'Cliente Teste',
            'email' => 'cliente@exemplo.com',
            'password' => Hash::make('senha123'),
            'tipo_usuario' => 'cliente', // Define como cliente
        ]);

        // Criar um administrador
        User::create([
            'name' => 'Admin Teste',
            'email' => 'admin@exemplo.com',
            'password' => Hash::make('senha123'),
            'tipo_usuario' => 'admin', // Define como administrador
        ]);
    }
}
