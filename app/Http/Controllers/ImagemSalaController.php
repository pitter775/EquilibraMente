<?php

namespace App\Http\Controllers;

use App\Models\ImagemSala;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;


class ImagemSalaController extends Controller
{
    public function index(Sala $sala)
    {
        $imagens = $sala->imagens; // Presume-se que a relação Sala -> Imagens já está configurada
        return response()->json(['imagens' => $imagens ?? []]);
    }

    // Armazenar imagens associadas a uma sala


    public function store(Request $request)
    {
        $validated = $request->validate([
            'sala_id' => 'required|exists:salas,id',
            'imagens.*' => 'max:4048' // Validando as imagens
        ]);
    
        // Verificar se existem imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                // Obter as dimensões da imagem original
                list($larguraOriginal, $alturaOriginal) = getimagesize($imagem);
    
                // Definir os limites máximos
                $maxLargura = 1440;
                $maxAltura = 1080;
    
                // Calcular a nova largura e altura mantendo a proporção
                $ratio = min($maxLargura / $larguraOriginal, $maxAltura / $alturaOriginal);
                $novaLargura = $larguraOriginal * $ratio;
                $novaAltura = $alturaOriginal * $ratio;
    
                // Criar uma nova imagem redimensionada
                $imagemRedimensionada = imagecreatetruecolor($novaLargura, $novaAltura);
                $imagemOriginal = imagecreatefromstring(file_get_contents($imagem));
                imagecopyresampled(
                    $imagemRedimensionada,
                    $imagemOriginal,
                    0,
                    0,
                    0,
                    0,
                    $novaLargura,
                    $novaAltura,
                    $larguraOriginal,
                    $alturaOriginal
                );
    
                // Converter a imagem redimensionada para base64
                ob_start();
                imagejpeg($imagemRedimensionada); // Salvar no buffer
                $dadosImagem = ob_get_clean();
                $imagemBase64 = 'data:image/jpeg;base64,' . base64_encode($dadosImagem);
    
                // Criar o registro da imagem no banco de dados
                ImagemSala::create([
                    'sala_id' => $request->sala_id,
                    'imagem_base64' => $imagemBase64, // Salva a imagem como base64
                ]);
    
                // Liberar memória
                imagedestroy($imagemRedimensionada);
                imagedestroy($imagemOriginal);
            }
        } else {
            return response()->json(['error' => 'Nenhuma imagem foi enviada.'], 400);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Imagens da sala salvas com sucesso!'
        ]);
    }
    
    


    public function definirPrincipal(ImagemSala $imagem)
    {
        Log::info('ID da Imagem recebida: ' . $imagem->id);
    
        // Agora continue com o processo
        ImagemSala::where('sala_id', $imagem->sala_id)->update(['principal' => false]);
        $imagem->principal = true;
        $imagem->save();
    
        return response()->json(['success' => true, 'message' => 'Imagem definida como principal!']);
    }
    
    

    
    // Excluir uma imagem
    public function destroy(ImagemSala $imagem)
    {
        // Apagar o registro do banco de dados
        $imagem->delete();

        return response()->json(['success' => true, 'message' => 'Imagem excluída com sucesso.']);
    }

    
    
}
