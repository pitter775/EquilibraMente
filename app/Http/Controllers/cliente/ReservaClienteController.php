<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Carbon\Carbon;
use App\Models\Transacao;

class ReservaClienteController extends Controller
{
    public function minhasReservas()
    {
        // --- manutenção on-demand ---
        $agora         = Carbon::now();
        $limiteCancel  = $agora->copy()->subMinutes(30); // pendente > 30min -> CANCELADA
        $limiteDelete  = $agora->copy()->subMonths(4);   // CANCELADA > 4m -> delete

        // 1) cancelar pendentes muito antigas (base: created_at)
        $pendentes = Reserva::where('usuario_id', auth()->id())
            ->whereIn('status', ['pendente','PENDENTE']) // case-safe
            ->where('created_at', '<', $limiteCancel)
            ->get();

        foreach ($pendentes as $r) {
            $r->status = 'cancelada';  // pad em minusc p/ bater com view
            $r->save();

            // up transações pendentes -> cancelada
            Transacao::where(function ($q) use ($r) {
                $q->where('reference_id', 'reserva_'.$r->id)
                  ->orWhere('reference_id', (string) $r->id);
            })
            ->whereIn('status', ['pendente','iniciada','aguardando','pending'])
            ->update(['status' => 'cancelada']);
        }

        // 2) deletar canceladas muito antigas (somente do usuário logado)
        Reserva::where('usuario_id', auth()->id())
            ->whereIn('status', ['cancelada','CANCELADA'])
            ->where('updated_at', '<', $limiteDelete)
            ->delete();
        // --- fim manutenção ---

        // ===== busca reservas do user =====
        // obs: mantemos o "contrato" do frontend: agrupamento por sala_id + data_reserva
        $reservas = Reserva::where('usuario_id', auth()->id())
            ->with(['sala.imagens', 'sala.endereco'])
            ->orderByDesc('created_at') // ultimas criadas primeiro só p/ consistência
            ->get();

        if ($reservas->isEmpty()) {
            // nada a listar — mantém contrato da view
            return view('cliente.minhas-reservas', [
                'reservas' => collect()
            ]);
        }

        // ===== carrega transações e mapeia por reference_id =====
        $refs = $reservas->flatMap(function ($r) {
            return ['reserva_'.$r->id, (string) $r->id];
        })->unique()->values();

        $transacoesPorRef = Transacao::where('usuario_id', auth()->id())
            ->whereIn('reference_id', $refs)
            ->get()
            ->keyBy('reference_id');

        // ===== monta grupos no formato esperado pela view =====
        // key visual = sala_id . '_' . data_reserva  (igual estava)
        // mas a "ordenação" dos grupos leva em conta a transação mais recente
        $gruposTmp = []; // [key_visual => ['ord' => Carbon, 'items' => Collection<Reserva>]]

        foreach ($reservas as $r) {
            $keyVisual = $r->sala_id . '_' . $r->data_reserva;

            // acha transação ligada a esta reserva (aceita 2 formatos de reference_id)
            $tx = $transacoesPorRef->get('reserva_'.$r->id) ?: $transacoesPorRef->get((string) $r->id);

            // base de ordenação do grupo:
            // - se houver transação: usa created_at da transação
            // - senão: usa maior (data_reserva + hora_fim) ou created_at da reserva
            $ordCandidato = null;
            if ($tx) {
                $ordCandidato = $tx->created_at instanceof \Carbon\Carbon
                    ? $tx->created_at
                    : Carbon::parse($tx->created_at);
            } else {
                if (!empty($r->data_reserva) && !empty($r->hora_fim)) {
                    $ordCandidato = Carbon::parse($r->data_reserva.' '.$r->hora_fim);
                } else {
                    $ordCandidato = $r->created_at instanceof \Carbon\Carbon
                        ? $r->created_at
                        : Carbon::parse($r->created_at);
                }
            }

            // inicia grupo se necessário
            if (!isset($gruposTmp[$keyVisual])) {
                $gruposTmp[$keyVisual] = [
                    'ord'   => $ordCandidato,
                    'items' => collect(),
                ];
            } else {
                // mantém a "ord" do grupo como a MAIOR entre as candidatas (puxando sempre o mais recente)
                if ($ordCandidato->gt($gruposTmp[$keyVisual]['ord'])) {
                    $gruposTmp[$keyVisual]['ord'] = $ordCandidato;
                }
            }

            // adiciona a reserva no grupo visual
            $gruposTmp[$keyVisual]['items']->push($r);
        }

        // ===== reordena grupos pela 'ord' desc e devolve coleção no formato antigo =====
        // importante: preserva a estrutura que a Blade espera: Collection<keyVisual => Collection<Reserva>>
        $gruposOrdenados = collect($gruposTmp)
            ->sortByDesc(fn ($g) => $g['ord'])
            ->map(fn ($g) => $g['items']);

        return view('cliente.minhas-reservas', [
            'reservas' => $gruposOrdenados
        ]);
    }



    public function verChave(Reserva $reserva)
    {
        return response()->json(['chave' => $reserva->chave_usada]);
    }

    public function cancelar(Reserva $reserva)
    {
        // seg — só o dono pode mexer
        if ($reserva->usuario_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Reserva não pertence a você.'], 403);
        }

        if (strtolower($reserva->status) !== 'pendente') {
            return response()->json(['success' => false, 'message' => 'Somente reservas pendentes podem ser canceladas.'], 422);
        }

        // marca como cancelada (não apaga — mantém histórico)
        $reserva->status = 'cancelada';
        $reserva->save();

        // se existir transação pendente, marca também
        \App\Models\Transacao::where('reference_id', 'reserva_'.$reserva->id)
            ->whereIn('status', ['pendente','iniciada','aguardando'])
            ->update(['status' => 'cancelada']);

        return response()->json(['success' => true]);
    }


}
