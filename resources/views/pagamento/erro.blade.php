@extends('layouts.site-interna', [
    'elementActive' => 'detalhes'
])

@section('content')
<div class="text-center mt-5">
  <h1 class="text-danger">❌ Erro no pagamento</h1>
  <p class="mt-3">{{ $mensagem ?? 'Houve um problema com sua transação.' }}</p>
  <a href="{{ url('/reserva/revisao') }}" class="btn btn-danger mt-4">Tentar novamente</a>
</div>
@endsection