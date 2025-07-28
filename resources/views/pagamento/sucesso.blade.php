@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
  <h1 class="text-success">✅ Pagamento aprovado!</h1>
  <p class="mt-3">Sua reserva foi confirmada com sucesso. Um e-mail com os detalhes foi enviado para você.</p>
  <a href="{{ url('/minhas-reservas') }}" class="btn btn-success mt-4">Ver Minhas Reservas</a>
</div>
@endsection