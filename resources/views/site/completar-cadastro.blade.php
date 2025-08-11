@extends('layouts.site-interna', [
    'elementActive' => 'detalhes'
])

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<style>
.is-invalid {
  border: 1px solid red !important;
}
</style>

<!-- Modal com o conteúdo do contrato -->
<div class="modal fade" id="modalContrato">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalContratoLabel">Contrato - {{ $contrato->versao ?? 'N/A' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
            </div>
            <div class="modal-body" style="white-space: pre-line;">
                <p>
                                INSTRUMENTO PARTICULAR DE CONTRATO DE PRESTAÇÃO DE SERVIÇOS

                                Pelo presente instrumento particular, as Partes:

                                CONTRATANTE: Nome: <span id="contrato_nome"></span>, Profissão: <span id="contrato_profissao"></span>, CPF: <span id="contrato_cpf"></span>, com endereço em <span id="contrato_endereco"></span>, com endereço eletrônico: <span id="contrato_email"></span>, telefone: <span id="contrato_telefone"></span>;

                                CONTRATADA: ESPAÇO EQUILIBRAMENTE LTDA, com sede na Cidade de São Paulo, Estado de São Paulo, na RUA DONA ANTÔNIA DE QUEIROS nº 504, cj 43 Edifício E C Higienópolis, Consolação, CEP: 01307-013, inscrita no CNPJ sob o nº 55.559.476/0001-59, com endereço eletrônico: equilibramente12@gmail.com;

                                As partes, de comum acordo e na melhor forma de direito, celebram o presente CONTRATO DE PRESTAÇÃO DE SERVIÇOS, o qual se regerá pelas cláusulas e condições a seguir estabelecidas.

                                I. OBJETO

                                O presente contrato tem por objeto a prestação de serviços de gestão e disponibilidade de salas para atendimento da área da saúde mental, localizado em Rua Dona Antônia de Queirós, nº 504 cj 43- 4 andar. do Edifício Higienópolis, Bairro Consolação, São Paulo/SP.

                                O Espaço poderá ser utilizado pelo contratante apenas para o desempenho de suas atividades como profissional da área da saúde mental, respeitados todos os termos do Regulamento Interno para uso do Espaço Equilibramente, o qual se encontra à disposição do Contratante na plataforma de agendamento de salas da Contratada www.espacoequilibramente.com.br (o “Regulamento de Uso do Espaço”) e faz parte integrante ao presente Contrato.

                                O Contratante declara ter pleno conhecimento e estar integralmente de acordo com os termos do Regulamento de Uso do Espaço, o qual se encontra disponível em https://www.espacoequilibramente.com.br/regulamento, obrigando-se a cumprir todas as suas disposições e regras.

                                II. ESPÉCIES DE CONTRATAÇÕES, PREÇOS E FORMAS DE PAGAMENTO

                                2.1. Pela prestação dos seus serviços, a Contratada fará jus aos valores estipulados conforme tabela de preço apresentada na Plataforma de Agendamento e de acordo com horários e espécies de contratação lá especificada.

                                2.2. Com o fim de refletir a variação dos custos dos serviços e insumos utilizados para a prestação dos serviços pela contratada, os valores indicados na plataforma, serão reajustados de acordo com as necessidades dos serviços e atualizações legais.

                                2.3. O pagamento poderá ser realizado através da plataforma no momento do agendamento e na forma disponibilizada no momento da contratação.

                                III. PRAZO E RESCISÃO

                                3.1. O presente Instrumento é celebrado em caráter irrevogável e irretratável e vigorará até a utilização da sala e hora contratada.

                                3.2. O presente Contrato poderá ser rescindido por qualquer Parte, a qualquer tempo e por qualquer motivo, mediante notificação por escrito à outra parte com antecedência mínima de 24 horas da hora agendada.

                                3.3. A Contratada poderá rescindir de pleno direito o presente Instrumento, na hipótese de a Contratante descumprir as normas dispostas no Regulamento de Uso do Espaço, independentemente da quantidade de horas contratada, sem prejuízo da aplicação de outras penalidades previstas neste instrumento.

                                IV. PENALIDADES

                                4.1. No caso de descumprimento de quaisquer obrigações deste instrumento ou do Regulamento de Uso de Espaço, o Contratante estará sujeito ao pagamento de multa não compensatória no valor de 02 (duas) vezes o valor estabelecido para Hora Avulsa por infração praticada, sem prejuízo de eventuais perdas e danos.

                                V. DISPOSIÇÕES FINAIS

                                5.1. A relação entre as Partes é a de contratantes independentes, de modo que as Partes de forma expressa, irretratável e livre, declaram que este contrato não constitui uma sociedade, associação ou parceria entre elas, tampouco estabelece qualquer vínculo empregatício de uma com a outra, ou com relação ao seu quadro pessoal.

                                5.2. Qualquer alteração nas disposições do presente contrato somente será realizada mediante aditamento celebrado por escrito entre as Partes.

                                5.3. Fica eleito o Foro Central da Comarca da Capital do Estado de São Paulo, com renúncia a qualquer outra, por mais privilegiada que seja, para dirimir qualquer questão relacionada ao presente Contrato.

                                E por estarem assim justas e contratadas, as partes firmam este instrumento em 02 (duas) vias de igual forma e teor, na presença de testemunhas.

                                São Paulo, <span id="contrato_data"></span>

                                CONTRATANTE: <span id="contrato_nome_final"></span>, <span id="contrato_endereco_final"></span>

                                CONTRATADA: ESPAÇO EQUILIBRAMENTE LTDA

                            
                </p>

                <div class="d-flex justify-content-end mt-4 gap-3">
                    <button id="btnAceitoContrato" class="btn btn-success">Aceito os termos</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Modal Documento -->
<div class="modal fade" id="modalDocumento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-5">
            <h4>Falta só mais um passo!</h4>
            <p>Envie uma foto de um documento com foto. Seus dados serão analisados pela nossa equipe.</p>

            <hr/>

            <form id="formDocumento" enctype="multipart/form-data">
                @csrf


                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="documento_tipo" class="form-label">Tipo de Documento</label>
                        <select id="documento_tipo" name="documento_tipo" class="form-control">
                            <option value="">Selecione...</option>
                            <option value="RG">RG</option>
                            <option value="CPF">CPF</option>
                            <option value="CNH">CNH</option>
                            <option value="Certidão de Nascimento">Certidão de Nascimento</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">                        
                        <label for="documento" class="btn btn-outline-primary">
                            <i class="bx bx-upload"></i> Escolher arquivo
                        </label>
                        <input type="file" id="documento" name="documento" accept=".jpg,.jpeg,.png,.pdf" style="display: none;" required>
                        <span id="nomeArquivo" class="text-muted d-block mt-1" style="font-size: 0.85rem;">Nenhum arquivo selecionado</span>
                        <img id="previewDocumento" src="#" alt="Pré-visualização" class="img-thumbnail mt-3" style="display: none; max-height: 200px;">
                    </div>
                </div>

                <p class="text-muted mt-4" style="font-size: 0.9em;">
                Seus dados estão protegidos conforme a <strong>LGPD</strong><div class="">  </div>
                </p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="aceita_contrato_modal" name="aceita_contrato_modal" required>
                    <label class="form-check-label" for="aceita_contrato">
                        Li e aceito os termos do contrato.
                    </label>
                </div>    

                <button type="submit" class="btn btn-success mt-2">Enviar Documento</button>
            </form>
        </div>
    </div>
</div>


<div class="container" style="margin-top: 120px; margin-bottom: 100px">
    <h4>
        {{ isset($googleData) && $googleData ? 'Completar Cadastro' : 'Cadastro Principal' }}
    </h4>
    <form id="completarCadastroForm" method="POST">
        @csrf
        <!-- Seção: Informações Básicas -->
        <div class="card p-4">
            <h4 class="mb-3">Informações Básicas</h4>
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

            <hr class="mb-5 mt-5">

            <h4>Login de Acesso</h4>
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

            <hr class="mb-5 mt-5">


            <h4>Informações Profissionais</h4>
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
            <h4 class="mb-3">Endereço</h4>
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

        @php
            $contrato = \App\Models\Contract::latest()->first();
        @endphp

        <style>
            .labelcontrato{ color: #777}
            .btn-termos {
                background-color: #d4edda; /* verde bem claro */
                color: #155724; /* verde escuro pro texto */
                border: 1px solid #c3e6cb;
                padding: 0.4rem 1rem;
                font-weight: 500;
                font-size: 0.95rem;
                border-radius: 6px;
                transition: 0.2s ease-in-out;
            }

            .btn-termos:hover {
                background-color: #c3e6cb;
                color: #0c3c2d;
                text-decoration: none;
            }
        </style>

       


        <div class="form-check mt-4 mb-4">
            <input class="form-check-input" type="checkbox" id="aceitaContrato" name="aceita_contrato" disabled required>
            <label class="form-check-label labelcontrato" for="aceitaContrato">
                Eu li e aceito os <a href="#" class="btn-termos" id="abrirModalContrato">termos do contrato</a>
.
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<!-- Script AJAX para envio do formulário usando toastr -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
        // 1. Intercepta o submit original e só mostra a modal
        $('#completarCadastroForm').on('submit', function(e) {
        e.preventDefault();

        if (!validarFormularioPrincipal()) {
            toastr.warning('Preencha todos os campos obrigatórios antes de continuar.');
            return;
        }

        if (!$('#aceitaContrato').is(':checked')) {
            toastr.warning('Você precisa aceitar os termos do contrato.');
            return;
        }

        $('#modalDocumento').modal('show');
        });

        // 2. Quando o usuário enviar o documento na modal
        $('#formDocumento').on('submit', function(e) {
            e.preventDefault();
            $('#aceitaContrato').prop('disabled', false);
            // Junta os dados do formulário principal + modal
            let formData = new FormData(document.getElementById('completarCadastroForm'));
            let docForm = new FormData(this);

            docForm.forEach((value, key) => {
                formData.append(key, value);
            });

            if (!validarDocumentoModal()) return;

            // Agora sim executa o AJAX com tudo junto
            $.ajax({
                url: "{{ route('completar.cadastro') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success('Cadastro enviado para análise!');
                    setTimeout(() => window.location.href = response.redirect || '/', 2000);
                },
                error: function(xhr) {
                    if (xhr.responseJSON?.errors) {
                        Object.values(xhr.responseJSON.errors).forEach(function(msgArray) {
                        toastr.error(msgArray[0]);
                        });
                    } else if (xhr.responseJSON?.error) {
                        toastr.error(xhr.responseJSON.error); // <- pega string direta
                    } else {
                        toastr.error('Erro ao enviar o cadastro.');
                    }
                }

            });
        });

        function preencherContrato() {
            const nome = document.getElementById('fullname')?.value || '';
            const cpf = document.getElementById('cpf')?.value || '';
            const profissao = document.getElementById('tipo_registro_profissional')?.value || '';
            const telefone = document.getElementById('telefone')?.value || '';
            const email = document.getElementById('email')?.value || '';

            const rua = document.getElementById('endereco_rua')?.value || '';
            const numero = document.getElementById('endereco_numero')?.value || '';
            const bairro = document.getElementById('endereco_bairro')?.value || '';
            const cidade = document.getElementById('endereco_cidade')?.value || '';
            const estado = document.getElementById('endereco_estado')?.value || '';
            const cep = document.getElementById('endereco_cep')?.value || '';

            const endereco = `${rua}, ${numero}, ${bairro}, ${cidade} - ${estado}, CEP: ${cep}`;

            document.getElementById('contrato_nome').innerText = nome;
            document.getElementById('contrato_nome_final').innerText = nome;
            document.getElementById('contrato_cpf').innerText = cpf;
            document.getElementById('contrato_profissao').innerText = profissao;
            document.getElementById('contrato_telefone').innerText = telefone;
            document.getElementById('contrato_email').innerText = email;
            document.getElementById('contrato_endereco').innerText = endereco;
            document.getElementById('contrato_endereco_final').innerText = endereco;

            const dataHoje = new Date();
            const dia = ('0' + dataHoje.getDate()).slice(-2);
            const mes = ('0' + (dataHoje.getMonth() + 1)).slice(-2);
            const ano = dataHoje.getFullYear();
            document.getElementById('contrato_data').innerText = `${dia}/${mes}/${ano}`;
        }

        function verificarCamposPreenchidos() {
            const campos = [
                'fullname', 'cpf', 'telefone', 'email',
                'endereco_rua', 'endereco_numero', 'endereco_bairro',
                'endereco_cidade', 'endereco_estado', 'endereco_cep',
                'senha', 'senha_confirmation'
            ];

            const todosPreenchidos = campos.every(id => document.getElementById(id)?.value.trim() !== '');

            const checkbox = document.getElementById('aceitaContrato');

            if (todosPreenchidos && checkbox) {
                checkbox.disabled = false;
                preencherContrato();
            } else if (checkbox) {
                checkbox.disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('input, select').forEach(element => {
                element.addEventListener('input', verificarCamposPreenchidos);
                element.addEventListener('change', verificarCamposPreenchidos);
            });

            verificarCamposPreenchidos();
        });
        document.getElementById('abrirModalContrato')?.addEventListener('click', function(e) {
            e.preventDefault();

            const campos = [
                'fullname', 'cpf', 'telefone', 'email',
                'endereco_rua', 'endereco_numero', 'endereco_bairro',
                'endereco_cidade', 'endereco_estado', 'endereco_cep',
                'senha', 'senha_confirmation'
            ];

            const todosPreenchidos = campos.every(id => document.getElementById(id)?.value.trim() !== '');

            if (!todosPreenchidos) {
                toastr.warning('Preencha todos os campos do formulário para visualizar o contrato.');
                return;
            }

            preencherContrato();
            $('#modalContrato').modal('show');
        });

        
        document.addEventListener('click', function (e) {
            if (e.target && e.target.id === 'btnAceitoContrato') {
                const aceiteGeral = document.getElementById('aceitaContrato');
                const btnSalvar = document.querySelector('button[type="submit"]');

                aceiteGeral.checked = true;
                aceiteGeral.disabled = false;
                btnSalvar.disabled = false;

                $('#modalContrato').modal('hide');
            }
        });

        function validarFormularioPrincipal() {
            let camposObrigatorios = [
                'fullname', 'cpf', 'telefone', 'email',
                'endereco_rua', 'endereco_numero', 'endereco_bairro',
                'endereco_cidade', 'endereco_estado', 'endereco_cep',
                'senha', 'senha_confirmation',
                'sexo', 'idade'
            ];

            let todosPreenchidos = true;

            camposObrigatorios.forEach(id => {
                let el = $('#' + id);
                if (!el.val() || el.val().trim() === '') {
                el.addClass('is-invalid');
                todosPreenchidos = false;
                } else {
                el.removeClass('is-invalid');
                }
            });

            // Valida se senha == confirmação
            let senha = $('#senha').val();
            let confirmacao = $('#senha_confirmation').val();

            if (senha !== confirmacao) {
                toastr.error('As senhas não conferem.');
                $('#senha, #senha_confirmation').addClass('is-invalid');
                todosPreenchidos = false;
            }

            return todosPreenchidos;
        }

        function validarDocumentoModal() {
            const tipo = $('#documento_tipo').val();
            const arquivo = $('input[name="documento"]').val();
            const aceite = $('#aceita_contrato_modal').is(':checked');

            let valido = true;

            if (!tipo) {
                toastr.warning('Selecione o tipo de documento.');
                valido = false;
            }

            if (!arquivo) {
                toastr.warning('Selecione um arquivo para envio.');
                valido = false;
            }

            if (!aceite) {
                toastr.warning('Você precisa aceitar os termos do contrato.');
                valido = false;
            }

            return valido;
        }

        $('#documento').on('change', function(e) {
            const file = e.target.files[0];
            $('#nomeArquivo').text(file.name || 'Nenhum arquivo selecionado');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#previewDocumento').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#previewDocumento').hide();
            }
        });





    });
</script>

@endsection
