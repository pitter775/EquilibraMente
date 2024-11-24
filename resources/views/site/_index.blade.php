
@if (Auth::check())
    @if (Auth::user()->tipo_usuario === 'admin')
        <script>window.location = "/admin";</script>
    @else
        <script>window.location = "/cliente/reservas";</script>
    @endif
@else

<!DOCTYPE html>
<html>
<head>
    <title>Login - Equilibra Mente</title>
    <!-- Adicione os links do Bootstrap/CSS aqui, se necessário -->
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>


        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
@endif