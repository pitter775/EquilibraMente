<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Transacao;
use App\Models\Sala;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{
    public function index()
    {
        $salas = Sala::with('imagens')->get();

        return view('site.index', compact('salas'));
    }
    

    public function detalhes($id)
    {
        // Busca a sala pelo ID, ou retorna 404 se não encontrada
        $sala = Sala::with('conveniencias')->findOrFail($id);

        // Renderiza uma view para exibir os detalhes da sala
        return view('site.detalhes', compact('sala'));
    }

    public function revisao(Request $request)
    {
    
        $validated = $request->validate([
            'sala_id' => 'required|exists:salas,id',
            'horarios' => 'required|array|min:1',
            'horarios.*.data_reserva' => 'required|date',
            'horarios.*.hora_inicio' => 'required|date_format:H:i',
            'horarios.*.hora_fim' => 'required|date_format:H:i|after:horarios.*.hora_inicio',
        ]);
    
        try {
            $sala = Sala::with('imagens')->findOrFail($validated['sala_id']);
            $valorTotal = count($validated['horarios']) * $sala->valor;
    
            // $imagemPrincipal = $sala->imagens->where('imagem_base64', true)->first();
    
            session([
                'reserva' => [
                    'sala_id' => $validated['sala_id'],
                    'sala_nome' => $sala->nome,
                    // 'imagem_principal' => $imagemPrincipal ? $imagemPrincipal->imagem_base64 : 'default.jpg',
                    'horarios' => $validated['horarios'],
                    'valor_total' => $valorTotal,
                ],
            ]);
    
            return response()->json(['redirect' => route('reserva.revisao')]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno.', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function exibirRevisao()
    {
        $reserva = session('reserva');
        
        if (!$reserva) {
            return redirect()->route('site.index')->with('error', 'Nenhuma reserva encontrada.');
        }

        // $sala = Sala::find($reserva['sala_id']);
        $sala = Sala::with('imagens')->findOrFail($reserva['sala_id']);
        $imagemPrincipal = $sala->imagens->where('imagem_base64', true)->first();




        return view('site.revisao', [
            'sala' => $sala,
            'horarios' => $reserva['horarios'],
            'valor_total' => $reserva['valor_total'],
            'imagem_principal' => $imagemPrincipal ? $imagemPrincipal->imagem_base64 : 'default.jpg',
        ]);
    }


    public function confirmar2(Request $request)
    {
        $reservaData = session('reserva');
    
        if (!$reservaData) {
            return response()->json(['success' => false, 'message' => 'Reserva inválida.']);
        }
    
        try {
            // Criar a reserva no banco de dados
            foreach ($reservaData['horarios'] as $horario) {
                Reserva::create([
                    'usuario_id' => auth()->id(),
                    'sala_id' => $reservaData['sala_id'],
                    'data_reserva' => $horario['data_reserva'],
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_fim' => $horario['hora_fim'],
                ]);
            }
    
            // Limpar a sessão da reserva
            session()->forget('reserva');
    
            return response()->json(['success' => true, 'message' => 'Reserva confirmada com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro ao confirmar a reserva.', 'error' => $e->getMessage()]);
        }
    }

    public function confirmar(Request $request)
    {
        $reservaData = session('reserva');
    
        if (!$reservaData) {
            return response()->json(['success' => false, 'message' => 'Reserva inválida.']);
        }
    
        try {
            // Criar as reservas no banco de dados
            $reservasCriadas = [];
            foreach ($reservaData['horarios'] as $horario) {
                $reserva = Reserva::create([
                    'usuario_id' => auth()->id(),
                    'sala_id' => $reservaData['sala_id'],
                    'data_reserva' => $horario['data_reserva'],
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_fim' => $horario['hora_fim'],
                    'status' => 'PENDENTE', // Status inicial
                ]);
                $reservasCriadas[] = $reserva;
            }
    
            // Gerar o link de pagamento
            $primeiraReserva = $reservasCriadas[0]; // Usar a primeira reserva para gerar o link
            $response = $this->gerarLinkPagamento($primeiraReserva->id);
    
            return $response; // Retorna o redirecionamento para o link do PagSeguro
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro ao confirmar a reserva.', 'error' => $e->getMessage()]);
        }
    }
    

    

    public function salvarReserva(Request $request)
    {
        // Obtém os dados da requisição ou da sessão
        $salaId = $request->input('sala_id', session('reserva.sala_id'));
        $horarios = $request->input('horarios', session('reserva.horarios'));
    
        // Valida se os dados necessários estão presentes
        if (!$salaId || !$horarios) {
            return response()->json([
                'success' => false,
                'message' => 'Dados da reserva estão incompletos ou ausentes.',
            ], 400);
        }
    
        try {
            $sala = Sala::findOrFail($salaId);
            $conflitos = [];
    
            // Verifica conflitos para os horários
            foreach ($horarios as $horario) {
                $conflict = $sala->reservas()
                    ->where('data_reserva', $horario['data_reserva'])
                    ->where(function ($query) use ($horario) {
                        $query->whereBetween('hora_inicio', [$horario['hora_inicio'], $horario['hora_fim']])
                              ->orWhereBetween('hora_fim', [$horario['hora_inicio'], $horario['hora_fim']]);
                    })->exists();
    
                if ($conflict) {
                    $conflitos[] = "{$horario['data_reserva']} - {$horario['hora_inicio']} às {$horario['hora_fim']}";
                }
            }
    
            // Retorna erro se houver conflitos
            if (!empty($conflitos)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Conflito de horário. A sala já está reservada nos seguintes horários: ' . implode(', ', $conflitos),
                ], 409);
            }
    
            // Cria as reservas
            $reservasCriadas = [];
            foreach ($horarios as $horario) {
                $reserva = $sala->reservas()->create([
                    'data_reserva' => $horario['data_reserva'],
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_fim' => $horario['hora_fim'],
                    'usuario_id' => auth()->id() ?? 1, // Usa o usuário logado ou um padrão
                ]);
                $reservasCriadas[] = $reserva;
            }
    
            // Limpa a sessão após criar as reservas
            session()->forget('reserva');
    
            return response()->json([
                'success' => true,
                'reservas' => $reservasCriadas,
                'message' => 'Reserva(s) criada(s) com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar a reserva.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




    public function gerarLinkPagamento($reservaId)
    {
        $reserva = Reserva::findOrFail($reservaId);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer 12a87e0f-1500-4d79-8708-e95ce88a4221f596a8ac4f87ae1316b90f34fd50713b889e-21a9-4514-bdac-4b1378c2f99f',
        ])->post('https://sandbox.api.pagseguro.com/orders', [
            'reference_id' => 'reserva_' . $reserva->id,
            'items' => [
                [
                    'name' => $reserva->sala->nome,
                    'quantity' => 1,
                    'unit_amount' => $reserva->sala->valor * 100, // Convertendo para centavos
                ]
            ],
            'charges' => [
                [
                    'payment_method' => 'CREDIT_CARD',
                    'amount' => [
                        'value' => $reserva->sala->valor * 100,
                    ],
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // Salvar na tabela transacoes
            $transacao = Transacao::create([
                'usuario_id' => auth()->id(),
                'sala_id' => $reserva->sala_id,
                'pagbank_order_id' => $data['id'],
                'reference_id' => $data['reference_id'],
                'valor' => $reserva->sala->valor,
                'status' => Transacao::STATUS_PENDENTE,
                'detalhes' => json_encode($data),
            ]);

            return redirect($data['links']['checkout']['href']);
        }

        return response()->json(['error' => 'Erro ao gerar o link de pagamento.'], 500);
    }

    
    
}
