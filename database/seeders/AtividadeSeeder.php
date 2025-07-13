<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Atividade;
use Illuminate\Support\Str;

class AtividadeSeeder extends Seeder
{
    public function run()
    {
        Atividade::truncate(); // limpa antes de popular

        $atividades = [
            [
                'descricao' => 'Atendimento individual',
                'hora_inicio' => '09:00',
                'hora_fim' => '10:00',
            ],
            [
                'descricao' => 'Reunião com equipe',
                'hora_inicio' => '11:00',
                'hora_fim' => '12:30',
            ],
            [
                'descricao' => 'Planejamento semanal',
                'hora_inicio' => '14:00',
                'hora_fim' => '15:00',
            ],
        ];

        foreach ($atividades as $atividade) {
            Atividade::create([
                'descricao' => $atividade['descricao'],
                'hora_inicio' => $atividade['hora_inicio'],
                'hora_fim' => $atividade['hora_fim'],
                'id_usuario' => null // ou define um ID se tiver auth
            ]);
        }
    }
}
