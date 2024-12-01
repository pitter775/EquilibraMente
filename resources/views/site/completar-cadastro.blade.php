@extends('layouts.site-interna', [
    'elementActive' => 'detalhes'
])

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="container" style="margin-top: 120px; margin-bottom: 100px">
    <h2>
        {{ isset($googleData) && $googleData ? 'Completar Cadastro' : 'Cadastro Principal' }}
    </h2>
    <form id="completarCadastroForm" method="POST">
        @csrf
        <!-- Seção: Informações Básicas -->
        <div class="card p-4">
            <h3 class="mb-3">Informações Básicas</h3>
            <input type="hidden" id="id_geral" name="id">
            <div class="row">
             @if(session('google_data.photo'))
                <div class="col-3">
                   
                    <div class="form-group">
                        <img src="{{ session('google_data.photo') }}" alt="Foto do Google" style="width: 100px; height: 100px;">
                        <input type="hidden" name="photo" value="{{ session('google_data.photo') }}">
                    </div>
                  
                </div>
                  @endif
                <div class="col-9">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="fullname" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ session('google_data.name') }}" required>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-1">
                    <label for="telefone" class="form-label">Telefone com DDD</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000">
                </div>
                <div class="col-md-4 mb-1">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                </div>
                <div class="col-md-2 mb-1">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-control">
                        <option value="">Selecione</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>
                <div class="col-md-2 mb-1">
                    <label for="idade" class="form-label">Idade</label>
                    <input type="number" class="form-control" id="idade" name="idade" min="0">
                </div>
            </div>

            <h3 class="mb-3 mt-5">Login de Acesso</h3>
            <div class="row">
                <div class="col-md-4 mb-1">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ session('google_data.email') }}" required>
                </div>
                <div class="col-md-4 mb-1">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>              
                <div class="col-md-4 mb-1">
                    <label for="senha_confirmation" class="form-label">Repetir Senha</label>
                    <input type="password" class="form-control" id="senha_confirmation" name="senha_confirmation" required>
                </div>
            </div>

            <h3 class="mb-3 mt-5">Informações Profissionais</h3>
            <div class="row">
                <div class="col-md-6 mb-1">
                    <label for="tipo_registro_profissional" class="form-label">Tipo de Registro</label>
                    <select id="tipo_registro_profissional" name="tipo_registro_profissional" class="form-control">
                        <option value="">Selecione</option>
                        <option value="CRM">CRM</option>
                        <option value="CRP">CRP</option>
                    </select>
                </div>
                <div class="col-md-6 mb-1">
                    <label for="registro_profissional" class="form-label">Registro Profissional</label>
                    <input type="text" class="form-control" id="registro_profissional" name="registro_profissional">
                </div>

            </div>
        </div>

        <!-- Seção: Endereço -->
        <div class="card p-4">
            <h3 class="mb-3">Endereço</h3>
            <div class="row">
                <div class="col-md-3 mb-1">
                    <label for="endereco_cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="endereco_cep" name="endereco_cep">
                </div>
                <div class="col-md-6 mb-1">
                    <label for="endereco_rua" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="endereco_rua" name="endereco_rua">
                </div>
                <div class="col-md-3 mb-1">
                    <label for="endereco_numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="endereco_numero" name="endereco_numero">
                </div>                       
            </div>
            <div class="row">
                <div class="col-md-3 mb-1">
                    <label for="endereco_complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="endereco_complemento" name="endereco_complemento">
                </div>
                <div class="col-md-3 mb-1">
                    <label for="endereco_bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="endereco_bairro" name="endereco_bairro">
                </div>
                <div class="col-md-4 mb-1">
                    <label for="endereco_cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="endereco_cidade" name="endereco_cidade">
                </div>
                <div class="col-md-2 mb-1">
                    <label for="endereco_estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="endereco_estado" name="endereco_estado">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<!-- Script AJAX para envio do formulário usando toastr -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
        $('#completarCadastroForm').on('submit', function(e) {
            e.preventDefault(); // Evita o envio padrão do formulário

            $.ajax({
                url: "{{ route('completar.cadastro') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    toastr.success('Cadastro completado com sucesso!');
                    setTimeout(function() {
                        window.location.href = response.redirect || '/'; // URL correta para redirecionamento
                    }, 2000);
                },
                error: function(xhr) {
                    console.log('Erro recebido:', xhr);
                    if (xhr.status === 422) { // Código de status para erros de validação
                        var response = xhr.responseJSON; // Garante que está acessando a resposta JSON

                        // Verifica se existe a propriedade "error" na resposta
                        if (response && response.error) {
                            toastr.error(response.error); // Exibe a mensagem do backend
                        } else if (response.errors) {
                            // Caso seja uma validação padrão com múltiplos erros
                            $.each(response.errors, function(key, messages) {
                                $.each(messages, function(index, message) {
                                    toastr.error(message); // Exibe cada mensagem de erro
                                });
                            });
                        } else {
                            toastr.error('Erro ao completar o cadastro. Tente novamente.');
                        }
                    } else {
                        toastr.error('Erro ao completar o cadastro.');
                    }
                }
            });
        });
    });
</script>

@endsection
