@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
  <h1 class="text-warning">⏳ Pagamento Pendente</h1>
  <p class="mt-3">Seu pagamento está sendo processado. Você será notificado assim que for aprovado.</p>
  <a href="{{ url('/') }}" class="btn btn-warning mt-4">Voltar para o site</a>
</div>
@endsection