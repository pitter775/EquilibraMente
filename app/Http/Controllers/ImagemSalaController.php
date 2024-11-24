<?php

namespace App\Http\Controllers;

use App\Models\ImagemSala;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validando as imagens
        ]);
    
        // Verificar se existem imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                // Salvar a imagem no disco (pasta storage/app/public/salas)
                $path = $imagem->store('salas', 'public');
    
                // Criar o registro da imagem no banco de dados
                ImagemSala::create([
                    'sala_id' => $request->sala_id,
                    'path' => $path
                ]);
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
        // Verificar se o arquivo da imagem existe no sistema
        if (Storage::disk('public')->exists($imagem->path)) {
            // Apagar o arquivo
            Storage::disk('public')->delete($imagem->path);
        }
    
        // Apagar o registro do banco de dados
        $imagem->delete();
    
        return response()->json(['success' => true, 'message' => 'Imagem excluída com sucesso.']);
    }
    
    
}
