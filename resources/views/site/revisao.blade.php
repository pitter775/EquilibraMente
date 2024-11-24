@extends('layouts.site-interna')

@section('content')
<div class="container mt-5">
    <h1>Revisão da Reserva</h1>

    <p><strong>Sala:</strong> {{ session('reserva.sala_nome') }}</p>
    <p><strong>Data e Horários:</strong></p>
    <ul>
        @foreach(session('reserva.horarios') as $horario)
            <li>{{ $horario['data_reserva'] }} - {{ $horario['hora_inicio'] }} às {{ $horario['hora_fim'] }}</li>
        @endforeach
    </ul>
    <p><strong>Valor Total:</strong> R$ {{ number_format(session('reserva.valor_total'), 2, ',', '.') }}</p>

    <form action="{{ route('reserva.confirmar') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
        <a href="{{ route('site.sala.detalhes', session('reserva.sala_id')) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
