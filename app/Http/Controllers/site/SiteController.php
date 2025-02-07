<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Transacao;
use App\Models\Sala;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\DebugLog;

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
            return response()->json(['success' => false, 'message' => 'Dados da reserva inválidos.']);
        }
    
        try {
            Log::info('Iniciando confirmação de reserva.', ['reservaData' => $reservaData]);
            DebugLog::create([ 'mensagem' => 'Iniciando confirmação de reserva: ' . json_encode($reservaData),]);

            // Captura a forma de pagamento escolhida pelo usuário
            $metodoPagamento = $request->input('metodo_pagamento', 'CREDIT_CARD'); // Padrão: Crédito
            
    
            // Criar reservas no banco
            $reservasCriadas = [];
            foreach ($reservaData['horarios'] as $horario) {
                $reserva = Reserva::create([
                    'usuario_id' => auth()->id(),
                    'sala_id' => $reservaData['sala_id'],
                    'data_reserva' => $horario['data_reserva'],
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_fim' => $horario['hora_fim'],
                    'status' => 'PENDENTE',
                    'forma_pagamento' => $metodoPagamento,
                ]);
                $reservasCriadas[] = $reserva;
            }
    
            // Gerar link de pagamento
            $primeiraReserva = $reservasCriadas[0];
            Log::info('Chamando geração de link de pagamento.', ['reserva_id' => $primeiraReserva->id]);
            DebugLog::create([ 'mensagem' => 'Chamando geração de link de pagamento.' . json_encode($primeiraReserva->id),]);
            
            $linkPagamento = $this->gerarLinkPagamento($primeiraReserva->id);
    
            return response()->json(['redirect' => $linkPagamento]);
        } catch (\Exception $e) {
            Log::error('Erro ao confirmar reserva:', ['error' => $e->getMessage()]);
            DebugLog::create([ 'mensagem' => 'Erro ao confirmar reserva:' . json_encode($e->getMessage()),]);
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
        $usuario = auth()->user();
    
        try {
            DebugLog::create(['mensagem' => 'Iniciando geração de link de pagamento para a reserva:' . $reserva->id]);
    
            $telefone = preg_replace('/[^0-9]/', '', $usuario->telefone);
            $cpf = preg_replace('/[^0-9]/', '', $usuario->cpf);
    
            $clienteData = [
                'name' => $usuario->name,
                'email' => $usuario->email,
                'tax_id' => $cpf,
                'phones' => [
                    [
                        'country' => '55',
                        'area' => substr($telefone, 0, 2),
                        'number' => substr($telefone, 2),
                        'type' => 'MOBILE',
                    ]
                ]
            ];
    
            $payload = [
                'reference_id' => 'reserva_' . $reserva->id,
                'customer' => $clienteData,
                'description' => 'Pagamento da reserva ' . $reserva->id,
                'amount' => [
                    'value' => (int) ($reserva->sala->valor * 100), // Ajuste para centavos
                    'currency' => 'BRL'
                ],
                'expiration_date' => now()->addDay()->toIso8601String(), // Expira em 24h
                'payment_methods' => [
                    ["type" => "credit_card"],
                    ["type" => "PIX"],
                    ["type" => "BOLETO"]
                ],
                'notification_urls' => [
                    'https://www.espacoequilibramente.com.br/pagbank/callback',
                ]
            ];
    
            DebugLog::create(['mensagem' => 'Dados de envio (payload):' . json_encode($payload)]);
    
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAGBANK_TOKEN'),
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])->post('https://sandbox.api.pagseguro.com/checkouts', $payload); // Endpoint correto
    
            if ($response->successful()) {
                $data = $response->json();
                DebugLog::create(['mensagem' => 'Link de pagamento gerado com sucesso:' . json_encode($data)]);
    
                // Retorna o link de pagamento gerado pelo PagBank
                if (isset($data['url'])) { // Ajuste para o campo correto
                    return response()->json(['redirect' => $data['url']]); // Link correto
                }
    
                throw new \Exception('Nenhum link de pagamento encontrado na resposta do PagBank.');
            } else {
                $error = $response->json();
                DebugLog::create(['mensagem' => 'Erro na resposta da API do PagBank:' . json_encode($error)]);
    
                throw new \Exception('Erro ao gerar o link de pagamento: ' . json_encode($error));
            }
        } catch (\Exception $e) {
            DebugLog::create(['mensagem' => 'Exceção ao gerar link de pagamento:' . json_encode($e->getMessage())]);
            return response()->json(['error' => 'Erro ao gerar link de pagamento.'], 500);
        }
    }
    
    
    
    
    

}
