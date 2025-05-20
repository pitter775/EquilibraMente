<h2>Revisar Cadastro</h2>

<p><strong>Nome:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Documento:</strong> {{ $user->documento_tipo }}</p>

@if($user->documento_identidade)
    @if(Str::endsWith($user->documento_identidade, ['jpg', 'jpeg', 'png']))
        <img src="{{ route('documento.ver', ['nome' => $user->documento_identidade]) }}" style="max-width: 400px;">
    @else
        <a href="{{ route('documento.ver', ['nome' => $user->documento_identidade]) }}" target="_blank">Visualizar documento</a>
    @endif
@endif

<form method="POST" action="{{ route('admin.usuario.aprovar', $user->id) }}">
  @csrf
  <button type="submit" class="btn btn-success">Aprovar</button>
</form>

<form method="POST" action="{{ route('admin.usuario.reprovar', $user->id) }}">
  @csrf
  <button type="submit" class="btn btn-danger">Reprovar</button>
</form>
