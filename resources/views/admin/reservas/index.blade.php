@extends('layouts.app', [
    'elementActive' => 'reservas'
])
@section('content')

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Botão para abrir o modal de Novo Usuário -->


    <!-- Modal para Adicionar/Editar Usuário -->
    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">Novo Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <h3 class="mt-2 ml-2">Reservas</h3>
                <p class="ml-2 mt-0">Ao definir os dados a serem cadastrados segue abaixo o botão se salvar.</p>
                <form id="newUserForm">
                    <div class="modal-body">
                                    
                        <!-- Seção: Informações Básicas -->
                        <div class="card p-2">
                            <h3 class="mb-3">Informações Básicas</h3>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    
                                    <p id="fullname" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    
                                    <p id="email" class="form-control-plaintext"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-1">
                                    
                                    <p id="telefone" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    
                                    <p id="cpf" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    
                                    <p id="sexo" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    
                                    <p  class="form-control-plaintext"> <span id="idade"></span> anos</p>
                                </div>
                                <div class="col-md-7 mb-1">
                                    <label class="form-label">URL da Foto</label>
                                    <p id="photo" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-5 mb-1">
                                    
                                    <p id="status" class="form-control-plaintext"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Seção: Informações Profissionais -->
                        <div class="card p-2">
                            <h3 class="mb-3">Informações Profissionais</h3>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Registro Profissional</label>
                                    <p id="registro_profissional" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Tipo de Registro</label>
                                    <p id="tipo_registro_profissional" class="form-control-plaintext"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Seção: Endereço -->
                        <div class="card p-2">
                            <h3 class="mb-3">Endereço</h3>
                            <div class="row">
                                <div class="col-md-3 mb-1">
                                    <label class="form-label">CEP</label>
                                    <p id="endereco_cep" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Rua</label>
                                    <p id="endereco_rua" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="form-label">Número</label>
                                    <p id="endereco_numero" class="form-control-plaintext"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-1">
                                    <label class="form-label">Complemento</label>
                                    <p id="endereco_complemento" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="form-label">Bairro</label>
                                    <p id="endereco_bairro" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <label class="form-label">Cidade</label>
                                    <p id="endereco_cidade" class="form-control-plaintext"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <label class="form-label">Estado</label>
                                    <p id="endereco_estado" class="form-control-plaintext"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal"><i data-feather='x'></i> Fechar</button>
                        
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
                            <h3 class="float-left mb-0">Reservas</h3>                
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 ">
                    <div class="form-group breadcrumb-right">
                                 

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
                                            <th>Sala</th>
                                            <th>Período da Reserva</th>
                                            <th>Valor por Hora</th> <!-- Coluna para valor por hora -->
                                            <th>Status</th>
                                            <th>Detalhes</th>
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

    <script src="../../../app-assets/js/scripts/pages/app-reservas-list.js"></script>
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



