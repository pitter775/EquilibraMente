<h3>Novo cadastro aguardando aprovação</h3>

<p><strong>Nome:</strong> {{ $user->name }}</p>
<p><strong>E-mail:</strong> {{ $user->email }}</p>
<p><strong>Telefone:</strong> {{ $user->telefone }}</p>

<a href="{{ $link }}" style="display:inline-block; padding:10px 20px; background:#007bff; color:white; text-decoration:none; border-radius:5px;">
  Abrir para aprovar
</a>