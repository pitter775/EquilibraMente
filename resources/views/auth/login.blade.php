<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
.button-container {
    display: flex;
    justify-content: space-between; /* Espaço igual entre os botões */
    gap: 10px; /* Espaço entre os botões */
    margin-top: 15px; /* Espaçamento do formulário */
}

.btn {
    padding: 10px 15px; /* Tamanho do botão */
    font-size: 14px; /* Tamanho do texto */
    text-align: center;
    text-decoration: none; /* Remove sublinhado */
    color: #fff; /* Cor do texto */
    border-radius: 5px; /* Bordas arredondadas */
    display: flex;
    align-items: center; /* Alinha o ícone ao texto */
    justify-content: center; /* Centraliza conteúdo */
    flex-grow: 1; /* Faz os botões terem o mesmo tamanho */
}

.btn-google {
    background-color: #545e51; /* Cor do botão Google */
}

.btn-google:hover {
    background-color: #c23321;
}

.btn-secondary {
    background-color: #6c757d; /* Cinza */
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.btn-entrar {
    background-color: #545e51 !important; /* Cor azul para chamar atenção */
    color: #fff; /* Cor do texto */
    border-radius: 5px; /* Bordas arredondadas */
    padding: 10px 20px; /* Espaçamento interno */
    font-weight: bold; /* Texto mais forte */
    text-transform: uppercase; /* Deixa o texto em letras maiúsculas */
    transition: background-color 0.3s ease; /* Transição suave */
}

.btn-entrar:hover {
    background-color: #0056b3; /* Azul mais escuro no hover */
    color: #fff; /* Cor do texto */
}




</style>

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

<div class="button-container">
    <a href="{{ route('login.google') }}" class="btn btn-google">
       Login com Google
    </a>
    <a href="{{ route('completar.cadastro.form') }}" class="btn btn-secondary">
        Cadastro Manual
    </a>
</div>

       

        

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                   Esqueceu a senha?
                </a>
            @endif
<x-primary-button class="btn-entrar ms-3">
    Entrar
</x-primary-button>

        </div>
    </form>
</x-guest-layout>
