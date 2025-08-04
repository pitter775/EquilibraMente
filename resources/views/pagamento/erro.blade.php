@extends('layouts.site-interna', [
    'elementActive' => 'detalhes'
])

@section('content')
<div class="text-center mt-5">
<div style=" height: 150px"></div>
  <h1 class="text-danger mt-10">Ooops um erro no pagamento</h1>
  <p class="mt-3">{{ $mensagem ?? 'Houve um problema com sua transação.' }}</p>
  <a href="{{ url('/reserva/revisao') }}" class="btn btn-danger mt-4 mb-10">Tentar novamente</a>
  <div style=" height: 200px"></div>
</div>
@endsection