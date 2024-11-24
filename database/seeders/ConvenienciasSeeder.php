<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConvenienciasSeeder extends Seeder
{
    public function run()
    {
        $conveniencias = [
            ['nome' => 'Espaço de convivência', 'icone' => 'icon-convivencia'],
            ['nome' => 'Opções de transporte', 'icone' => 'icon-transporte'],
            ['nome' => 'Área de Espera', 'icone' => 'icon-espera'],
            ['nome' => 'Café', 'icone' => 'icon-cafe'],
            ['nome' => 'Wifi', 'icone' => 'icon-wifi'],
            ['nome' => 'Localização no centro', 'icone' => 'icon-localizacao'],
            ['nome' => 'Equipamentos de ponta', 'icone' => 'icon-equipamentos'],
            ['nome' => 'Ambiente elegante', 'icone' => 'icon-elegante'],
            ['nome' => 'Ar condicionado', 'icone' => 'icon-ar-condicionado'],
            ['nome' => 'Estacionamento', 'icone' => 'icon-estacionamento'],
            ['nome' => 'Acessibilidade', 'icone' => 'icon-acessibilidade'],
            ['nome' => 'Recepção', 'icone' => 'icon-recepcao'],
            ['nome' => 'Segurança 24h', 'icone' => 'icon-seguranca'],
            ['nome' => 'Sala de reuniões', 'icone' => 'icon-reunioes'],
            ['nome' => 'Videoconferência', 'icone' => 'icon-videoconferencia'],
            ['nome' => 'Projetor multimídia', 'icone' => 'icon-projetor'],
            ['nome' => 'Impressora', 'icone' => 'icon-impressora'],
            ['nome' => 'Quadro branco', 'icone' => 'icon-quadro-branco'],
            ['nome' => 'Cadeiras ergonômicas', 'icone' => 'icon-cadeiras'],
            ['nome' => 'Serviço de limpeza', 'icone' => 'icon-limpeza'],
            ['nome' => 'Janelas com vista', 'icone' => 'icon-vista'],
            ['nome' => 'Iluminação natural', 'icone' => 'icon-iluminacao'],
            ['nome' => 'Som ambiente', 'icone' => 'icon-som'],
            ['nome' => 'Bicicletário', 'icone' => 'icon-bicicletario'],
            ['nome' => 'Espaço para eventos', 'icone' => 'icon-eventos'],
            ['nome' => 'Cozinha compartilhada', 'icone' => 'icon-cozinha'],
            ['nome' => 'Telefone fixo', 'icone' => 'icon-telefone'],
            ['nome' => 'Monitor', 'icone' => 'icon-monitor'],
            ['nome' => 'Rede cabeada', 'icone' => 'icon-rede-cabeada'],
            ['nome' => 'Chave eletrônica', 'icone' => 'icon-chave'],
            ['nome' => 'Espaço para coworking', 'icone' => 'icon-coworking'],
            ['nome' => 'Alto padrão de acabamento', 'icone' => 'icon-acabamento'],
            ['nome' => 'Atendimento personalizado', 'icone' => 'icon-atendimento'],
        ];

        DB::table('conveniencias')->insert($conveniencias);
    }
}

