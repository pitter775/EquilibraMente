<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvenienciasSeeder extends Seeder
{
    public function run()
    {
        $conveniencias = [
            ['nome' => 'Espaço de convivência', 'icone' => 'fa-solid fa-users'],
            ['nome' => 'Opções de transporte', 'icone' => 'fa-solid fa-bus'],
            ['nome' => 'Área de Espera', 'icone' => 'fa-solid fa-chair'],
            ['nome' => 'Café', 'icone' => 'fa-solid fa-coffee'],
            ['nome' => 'Wifi', 'icone' => 'fa-solid fa-wifi'],
            ['nome' => 'Localização no centro', 'icone' => 'fa-solid fa-map-marker-alt'],
            ['nome' => 'Equipamentos de ponta', 'icone' => 'fa-solid fa-tools'],
            ['nome' => 'Ambiente elegante', 'icone' => 'fa-solid fa-landmark'],
            ['nome' => 'Ar condicionado', 'icone' => 'fa-solid fa-fan'],
            ['nome' => 'Estacionamento', 'icone' => 'fa-solid fa-parking'],
            ['nome' => 'Acessibilidade', 'icone' => 'fa-solid fa-wheelchair'],
            ['nome' => 'Recepção', 'icone' => 'fa-solid fa-concierge-bell'],
            ['nome' => 'Segurança 24h', 'icone' => 'fa-solid fa-shield-alt'],
            ['nome' => 'Sala de reuniões', 'icone' => 'fa-solid fa-door-closed'],
            ['nome' => 'Videoconferência', 'icone' => 'fa-solid fa-video'],
            ['nome' => 'Projetor multimídia', 'icone' => 'fa-solid fa-project-diagram'],
            ['nome' => 'Impressora', 'icone' => 'fa-solid fa-print'],
            ['nome' => 'Quadro branco', 'icone' => 'fa-solid fa-chalkboard'],
            ['nome' => 'Cadeiras ergonômicas', 'icone' => 'fa-solid fa-chair'],
            ['nome' => 'Serviço de limpeza', 'icone' => 'fa-solid fa-broom'],
            ['nome' => 'Janelas com vista', 'icone' => 'fa-solid fa-window-maximize'],
            ['nome' => 'Iluminação natural', 'icone' => 'fa-solid fa-lightbulb'],
            ['nome' => 'Som ambiente', 'icone' => 'fa-solid fa-volume-up'],
            ['nome' => 'Bicicletário', 'icone' => 'fa-solid fa-bicycle'],
            ['nome' => 'Espaço para eventos', 'icone' => 'fa-solid fa-calendar-alt'],
            ['nome' => 'Cozinha compartilhada', 'icone' => 'fa-solid fa-utensils'],
            ['nome' => 'Telefone fixo', 'icone' => 'fa-solid fa-phone'],
            ['nome' => 'Monitor', 'icone' => 'fa-solid fa-tv'],
            ['nome' => 'Rede cabeada', 'icone' => 'fa-solid fa-network-wired'],
            ['nome' => 'Chave eletrônica', 'icone' => 'fa-solid fa-key'],
            ['nome' => 'Espaço para coworking', 'icone' => 'fa-solid fa-briefcase'],
            ['nome' => 'Alto padrão de acabamento', 'icone' => 'fa-solid fa-brush'],
            ['nome' => 'Atendimento personalizado', 'icone' => 'fa-solid fa-user-tie'],
        ];
        

        DB::table('conveniencias')->insert($conveniencias);
    }
}

