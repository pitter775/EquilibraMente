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
        // User::create([
        //     'name' => 'Cliente Teste',
        //     'email' => 'pitter775@gmail.com1',
        //     'password' => Hash::make('123'),
        //     'tipo_usuario' => 'cliente', // Define como cliente
        // ]);

        // Criar um administrador
        User::create([
            'name' => 'Admin Teste',
            'email' => 'pitter775@gmail.com2',
            'password' => Hash::make('123'),
            'tipo_usuario' => 'admin', // Define como administrador
        ]);
    }
}
