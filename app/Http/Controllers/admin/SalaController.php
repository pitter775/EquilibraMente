<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Conveniencia;
use App\Models\Endereco;
use App\Models\ImagemSala;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::all();
        $salas = Sala::with(['endereco', 'conveniencias'])->get();
        $conveniencias = Conveniencia::all();

        return view('admin.salas.index', compact('enderecos', 'salas', 'conveniencias'));
    }

    public function create()
    {
        $enderecos = Endereco::all();

        return view('admin.salas.create', compact('enderecos'));
    }

    public function getSalaData(Sala $sala)
    {
        $sala->load([
            'endereco',
            'imagens',
            'conveniencias',
            'bloqueios' => function ($query) {
                $query->with('criador')->latest('data_inicio')->latest('created_at');
            }
        ]);

        return response()->json([
            'sala' => $sala,
            'conveniencias' => Conveniencia::all(),
            'conveniencias_selecionadas' => $sala->conveniencias->pluck('id'),
            'bloqueios' => $sala->bloqueios,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'status' => 'required|string',
            'valor' => 'required|numeric',
            'metragem' => 'required|string',
            'endereco.rua' => 'required|string|max:255',
            'endereco.numero' => 'required|string|max:50',
            'endereco.bairro' => 'required|string|max:255',
            'endereco.cidade' => 'required|string|max:255',
            'endereco.estado' => 'required|string|max:100',
            'endereco.cep' => 'required|string|max:20',
            'endereco.complemento' => 'nullable|string|max:255',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'conveniencias' => 'nullable|array',
            'conveniencias.*' => 'integer|exists:conveniencias,id',
        ]);

        $sala = Sala::create($validated);
        $sala->endereco()->create($request->input('endereco'));

        if (!empty($validated['conveniencias'])) {
            $sala->conveniencias()->sync($validated['conveniencias']);
        }

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $index => $imagem) {
                list($larguraOriginal, $alturaOriginal) = getimagesize($imagem);

                $maxLargura = 1440;
                $maxAltura = 1080;
                $ratio = min($maxLargura / $larguraOriginal, $maxAltura / $alturaOriginal);
                $novaLargura = $larguraOriginal * $ratio;
                $novaAltura = $alturaOriginal * $ratio;

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

                ob_start();
                imagejpeg($imagemRedimensionada);
                $dadosImagem = ob_get_clean();
                $imagemBase64 = 'data:image/jpeg;base64,' . base64_encode($dadosImagem);

                ImagemSala::create([
                    'sala_id' => $sala->id,
                    'imagem_base64' => $imagemBase64,
                    'principal' => $index === 0,
                ]);

                imagedestroy($imagemRedimensionada);
                imagedestroy($imagemOriginal);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Sala criada com sucesso!',
            'data' => $sala->load('endereco', 'imagens', 'conveniencias')
        ]);
    }

    public function edit(Sala $sala)
    {
        $enderecos = Endereco::all();
        $conveniencias = Conveniencia::all();
        $sala->load('endereco', 'imagens', 'conveniencias');

        return response()->json([
            'sala' => $sala,
            'enderecos' => $enderecos,
            'imagens' => $sala->imagens,
            'conveniencias' => $conveniencias,
            'conveniencias_selecionadas' => $sala->conveniencias->pluck('id')
        ]);
    }

    public function update(Request $request, Sala $sala)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'status' => 'required|string',
            'valor' => 'required|numeric',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'conveniencias' => 'nullable|array',
            'conveniencias.*' => 'integer|exists:conveniencias,id',
        ]);

        $sala->update($validated);
        $sala->conveniencias()->sync($validated['conveniencias'] ?? []);

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $index => $imagem) {
                list($larguraOriginal, $alturaOriginal) = getimagesize($imagem);

                $maxLargura = 1440;
                $maxAltura = 1080;
                $ratio = min($maxLargura / $larguraOriginal, $maxAltura / $alturaOriginal);
                $novaLargura = $larguraOriginal * $ratio;
                $novaAltura = $alturaOriginal * $ratio;

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

                ob_start();
                imagejpeg($imagemRedimensionada);
                $dadosImagem = ob_get_clean();
                $imagemBase64 = 'data:image/jpeg;base64,' . base64_encode($dadosImagem);

                ImagemSala::create([
                    'sala_id' => $sala->id,
                    'imagem_base64' => $imagemBase64,
                    'principal' => $index === 0,
                ]);

                imagedestroy($imagemRedimensionada);
                imagedestroy($imagemOriginal);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Sala atualizada com sucesso!',
            'data' => $sala->load('endereco', 'imagens', 'conveniencias')
        ]);
    }

    public function destroy(Sala $sala)
    {
        $sala->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sala excluída com sucesso!'
        ]);
    }

    public function getSalasData(Request $request)
    {
        $salas = Sala::query();

        if ($request->has('status') && !empty($request->status)) {
            $salas->where('status', $request->status);
        }

        if ($request->has('busca') && !empty($request->busca)) {
            $busca = $request->busca;
            $salas->where(function ($query) use ($busca) {
                $query->where('nome', 'LIKE', '%' . $busca . '%')
                    ->orWhere('descricao', 'LIKE', '%' . $busca . '%');
            });
        }

        $salasList = $salas->with(['imagens' => function ($query) {
            $query->where('principal', true);
        }])->get();

        $quantidade = $salasList->count();

        return response()->json([
            'salas' => $salasList,
            'quantidade' => $quantidade
        ]);
    }
}
