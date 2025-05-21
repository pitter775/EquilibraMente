@extends('layouts.app', [
    'elementActive' => 'usuarios'
])
@section('content')

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Botão para abrir o modal de Novo Usuário -->


<!-- Modal para Visualizar Dados do Usuário -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Detalhes do Usuário</h5>
                 <input type="hidden" id="id_geral" name="id">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-1 mt-2" id="userTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="dados-tab" data-toggle="tab" href="#dados" role="tab">Dados Cadastrais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="documento-tab" data-toggle="tab" href="#documento" role="tab">Documento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="aprovacao-tab" data-toggle="tab" href="#aprovacao" role="tab">Aprovação</a>
                    </li>
                </ul>

                <div class="tab-content" id="userTabContent">
                    <!-- Dados Cadastrais -->
                    <div class="tab-pane fade show active" id="dados" role="tabpanel">
                        <div class="card p-3">

                            <h3 class="mb-4">Informações Cadastrais</h3>
                            <p><strong>Nome:</strong> <span id="fullname"></span></p>
                            <p><strong>Email:</strong> <span id="email"></span></p>
                            <p><strong>Telefone:</strong> <span id="telefone"></span></p>
                            <p><strong>CPF:</strong> <span id="cpf"></span></p>
                            <p><strong>Sexo:</strong> <span id="sexo"></span></p>
                            <p><strong>Idade:</strong> <span id="idade"></span></p>
                            <p><strong>Registro Profissional:</strong> <span id="registro_profissional"></span> (<span id="tipo_registro_profissional"></span>)</p>
                            <p><strong>Endereço:</strong> <span id="endereco"></span></p>
                        </div>
                    </div>

                    <!-- Documento -->
                    <div class="tab-pane fade" id="documento" role="tabpanel">
                        <div class="card p-3 text-center">
                            <h3 class="mb-4">Documento do Usuário</h3>
                            <p><strong>Tipo de Documento:</strong> <span id="documento_tipo"></span></p>
                            <a id="link_documento" href="#" target="_blank">
                                <img id="imagem_documento" src="#" class="img-fluid rounded" style="max-height: 400px; cursor: zoom-in;">
                            </a>
                        </div>
                    </div>

                    <!-- Aprovação -->
                    <div class="tab-pane fade" id="aprovacao" role="tabpanel">
                        <div class="card p-3">
                        <h3 class="mb-4">Status de Aprovação</h3>
                            <form id="formAprovacaoUsuario">
                                <input type="hidden" id="usuario_id_aprovacao" name="id">
                                <p class="mb-4"><strong>Status Atual:</strong> <span id="status_aprovacao" class="badge badge-secondary"></span></p>

                                    <hr>

                                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Aprovar</button>
                                <button type="button" class="btn btn-danger ml-2" id="btnReprovarUsuario"><i class="fas fa-times-circle"></i> Reprovar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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



