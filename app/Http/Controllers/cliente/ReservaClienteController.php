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
            $r->status = 'cancelada';  // padroniza em maiúsculo p/ casar com a view
            $r->save();

            // atualiza transação ligada (pendente/aguardando -> cancelada)
            Transacao::where(function ($q) use ($r) {
                $q->where('reference_id', 'reserva_'.$r->id)
                  ->orWhere('reference_id', (string) $r->id);
            })
                ->whereIn('status', ['pendente','iniciada','aguardando','pending'])
                ->update(['status' => 'cancelada']); // mantive pt-BR p/ compat com teu status()
        }

        // (opcional) se preferir basear no horário da reserva em vez do created_at:
        // Reserva::where('usuario_id', auth()->id())
        //   ->whereIn('status', ['pendente','PENDENTE'])
        //   ->whereRaw("STR_TO_DATE(CONCAT(data_reserva,' ',hora_inicio), '%Y-%m-%d %H:%i:%s') < ?", [$agora->copy()->subMinutes(30)])
        //   ->update(['status' => 'CANCELADA']);

        // 2) deletar canceladas muito antigas (somente do usuário logado)
        Reserva::where('usuario_id', auth()->id())
            ->whereIn('status', ['cancelada','CANCELADA'])
            ->where('updated_at', '<', $limiteDelete)
            ->delete();
        // --- fim manutenção ---

        $reservas = Reserva::where('usuario_id', auth()->id())
            ->with(['sala.imagens', 'sala.endereco'])
            ->orderBy('data_reserva', 'desc')
            ->get()
            ->groupBy(fn ($reserva) => $reserva->sala_id . '_' . $reserva->data_reserva);

        return view('cliente.minhas-reservas', compact('reservas'));
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
