@extends('layouts.app', [
    'elementActive' => 'usuarios'
])
@section('content')

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Botão para abrir o modal de Novo Usuário -->


<!-- Modal para Adicionar/Editar Usuário -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Novo Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span >&times;</span>
                </button>
            </div>
            <h3 class="mt-2 ml-2">Cadastro de Usuários</h3>
            <p class="ml-2 mt-0">Ao definir os dados a serem cadastrados segue abaixo o botão se salvar.</p>
            <form id="newUserForm">
                <div class="modal-body">
                    
                    <!-- Seção: Informações Básicas -->
                    <div class="card p-2">
                        <h3 class="mb-3">Informações Básicas</h3>
                        <input type="hidden" id="id_geral" name="id">
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="fullname" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
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

                            <div class="col-md-7 mb-1">
                                <label for="photo" class="form-label">URL da Foto</label>
                                <input type="text" class="form-control" id="photo" name="photo">
                            </div>

                            <div class="col-md-5 mb-1">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                     </div>

                    <!-- Seção: Informações de Login e Perfil -->
                    <div class="card p-2">
                        <h3 class="mb-3">Informações de Login e Perfil</h3>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="perfil" class="form-label">Perfil</label>
                                <select id="perfil" name="perfil" class="form-control" required>
                                    <option value="cliente">Cliente</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="senha" class="form-label" id="senhalabel">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                        </div>
                     </div>

                    <!-- Seção: Informações Profissionais -->
                    <div class="card p-2">
                        <h3 class="mb-3">Informações Profissionais</h3>
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label for="registro_profissional" class="form-label">Registro Profissional</label>
                                <input type="text" class="form-control" id="registro_profissional" name="registro_profissional">
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="tipo_registro_profissional" class="form-label">Tipo de Registro</label>
                                <select id="tipo_registro_profissional" name="tipo_registro_profissional" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="CRM">CRM</option>
                                    <option value="CRP">CRP</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Seção: Endereço -->
                    <div class="card p-2">
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



                    
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal"><i data-feather='x'></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>


   <div class="">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
 
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h3 class="float-left mb-0">Gerenciamento de Usuários</h3>
                
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 ">
                    <div class="form-group breadcrumb-right">
                                 <a href="#" class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0 float-right ml-2 create-new" style=" z-index: 80;"   data-toggle="modal" data-target="#newUserModal">
                                            <i data-feather="heart" ></i>
                                            <span class="">Criar Usuário</span>
                                        </a>

                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card" style="padding: 20px">                           
                            <!-- Conteúdo da página e tabela de usuários -->
                            <div class="table-responsive">
                 
                                <table class="table user-list-table">
                                    <thead>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Telefone</th>
                                            <th>Perfil</th>
                                            <th>Status</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Carregado via DataTable -->
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->

            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        // Aplica a máscara ao campo de CEP e telefone ao abrir o modal
        $('#newUserModal').on('shown.bs.modal', function () {
            $('#endereco_cep').mask('00000-000');
            $('#telefone').mask('(00) 00000-0000');
        });

        // Evento para buscar endereço quando o CEP é preenchido
        $(document).on('blur', '#endereco_cep', function () {
            let cep = $(this).val().replace(/\D/g, '');

            // Verifica se o CEP tem 8 dígitos
            if (cep.length === 8) {
                $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                    if (!("erro" in data)) {
                        // Preenche os campos com os dados retornados pela API
                        $('#endereco_rua').val(data.logradouro);
                        $('#endereco_bairro').val(data.bairro);
                        $('#endereco_cidade').val(data.localidade);
                        $('#endereco_estado').val(data.uf);
                    } else {
                        // Se o CEP for inválido
                        toastr.error("CEP não encontrado.");
                    }
                }).fail(function() {
                    toastr.error("Erro ao buscar o endereço. Tente novamente.");
                });
            } else {
                toastr.warning("CEP inválido. Insira um CEP com 8 dígitos.");
            }
        });
    });
</script>





@endsection

@push('css_vendor')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">   
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">  
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">  
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">

@endpush

@push('css_page')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-user.css">
    
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-validation.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
@endpush

@push('js_page')
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script> 
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    
    
    <script src="../../../app-assets/js/scripts/forms/form-select2.js"></script> 
    <script src="../../../app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
    <script src="../../../app-assets/js/scripts/forms/pickers/form-pickers.js"></script>

    <script src="../../../app-assets/js/scripts/pages/app-usuario-list.js"></script>
@endpush

@push('js_vendor')
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    
    
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    
@endpush



