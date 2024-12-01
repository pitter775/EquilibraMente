<style>

.btn-entrar {
    background-color: #545e51 !important; /* Cor azul para chamar atenção */
    color: #fff; /* Cor do texto */
    border-radius: 5px; /* Bordas arredondadas */
    padding: 10px 20px; /* Espaçamento interno */
    font-weight: bold; /* Texto mais forte */
    text-transform: uppercase; /* Deixa o texto em letras maiúsculas */
    transition: background-color 0.3s ease; /* Transição suave */
}

</style>

<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esqueceu sua senha? Sem problema. Basta informar seu endereço de e-mail, e nós enviaremos um link de redefinição de senha para que você possa escolher uma nova.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="btn-entrar">
                {{ __('Enviar Redefinição de Senha por Email') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
