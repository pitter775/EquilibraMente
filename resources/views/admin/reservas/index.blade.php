@extends('layouts.app', [
    'elementActive' => 'reservas'
])
@section('content')

<style>
    .reservas-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .reservas-toolbar-copy h3 {
        margin-bottom: 6px;
        color: #4f7e48;
        display: block;
    }

    .reservas-toolbar-copy p {
        margin-bottom: 0;
        color: #7c8578;
        display: block;
        width: 100%;
    }

    .reservas-toolbar-copy {
        display: block;
        flex: 1 1 100%;
    }

    .reservas-filters {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .reservas-filter {
        min-width: 180px;
    }

    .reservas-filter label {
        display: block;
        margin-bottom: 6px;
        color: #5c6758;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .reserva-avatar {
        width: 36px;
        height: 36px;
        border-radius: 999px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .reserva-avatar-fallback {
        width: 36px;
        height: 36px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #edf6ea;
        color: #4f7e48;
        font-weight: 700;
        font-size: 12px;
        flex-shrink: 0;
    }

    .reserva-person {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 170px;
    }

    .reserva-person-name {
        font-weight: 700;
        color: #495057;
        line-height: 1.35;
    }

    .reserva-person-meta {
        color: #7c8578;
        font-size: 12px;
        line-height: 1.35;
        margin-top: 2px;
    }

    .reserva-contact {
        min-width: 170px;
        color: #5d645b;
        line-height: 1.5;
    }

    .reserva-contact strong,
    .reserva-sala strong,
    .reserva-periodo strong,
    .reserva-valor strong {
        display: block;
        color: #495057;
        margin-bottom: 2px;
    }

    .reserva-sala,
    .reserva-periodo,
    .reserva-valor {
        color: #5d645b;
        line-height: 1.5;
    }

    .reserva-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .reserva-status-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: currentColor;
    }

    .reserva-status-confirmada {
        background: #edf7ea;
        color: #347245;
    }

    .reserva-status-pendente {
        background: #fff6df;
        color: #a87a16;
    }

    .reserva-status-cancelada {
        background: #fff0f0;
        color: #bf5454;
    }

    .reserva-status-default {
        background: #f1f3f5;
        color: #66707a;
    }

    .reserva-status-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .reserva-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .reserva-actions .btn {
        white-space: nowrap;
    }

    .reserva-actions .btn + .btn {
        margin-left: 0;
    }

    .user-list-table {
        width: 100% !important;
    }

    .user-list-table th:nth-child(1),
    .user-list-table td:nth-child(1) {
        width: 17%;
    }

    .user-list-table th:nth-child(2),
    .user-list-table td:nth-child(2) {
        width: 15%;
    }

    .user-list-table th:nth-child(3),
    .user-list-table td:nth-child(3) {
        width: 13%;
    }

    .user-list-table th:nth-child(4),
    .user-list-table td:nth-child(4) {
        width: 26%;
    }

    .user-list-table th:nth-child(5),
    .user-list-table td:nth-child(5) {
        width: 29%;
    }

    .table-responsive {
        width: 100%;
    }

    .user-list-table.dataTable {
        table-layout: fixed;
    }

    .reserva-modal-hero {
        display: grid;
        grid-template-columns: 360px minmax(0, 1fr);
        gap: 24px;
        margin-bottom: 20px;
    }

    .reserva-modal-image {
        width: 100%;
        height: 240px;
        border-radius: 18px;
        object-fit: cover;
        box-shadow: 0 14px 34px rgba(44, 62, 36, 0.12);
        background: #f4f7f2;
    }

    .reserva-modal-panel {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .reserva-modal-headerline {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .reserva-modal-kicker {
        color: #7c8578;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
    }

    .reserva-modal-title {
        margin-bottom: 4px;
        color: #355b33;
    }

    .reserva-modal-subtitle {
        margin-bottom: 0;
        color: #6f7b6c;
    }

    .reserva-modal-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .reserva-detail-card {
        border: 1px solid #ebf0e8;
        border-radius: 16px;
        background: #fff;
        padding: 16px;
    }

    .reserva-detail-card h6 {
        color: #4f7e48;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .reserva-detail-line {
        color: #5d645b;
        line-height: 1.55;
    }

    .reserva-detail-line strong {
        color: #495057;
    }

    .reserva-hours-list {
        padding-left: 18px;
        margin-bottom: 0;
        color: #5d645b;
    }

    .reserva-hours-list li + li {
        margin-top: 4px;
    }

    .reserva-modal-footer-note {
        margin-right: auto;
        color: #7c8578;
        font-size: 13px;
    }

    @media (max-width: 1500px) {
        .user-list-table th,
        .user-list-table td {
            padding: 0.72rem 0.45rem;
            vertical-align: top;
        }

        .reservas-filter {
            min-width: 150px;
        }

        .reserva-person {
            min-width: 140px;
            gap: 8px;
        }

        .reserva-contact {
            min-width: 135px;
            font-size: 13px;
        }

        .reserva-sala,
        .reserva-periodo,
        .reserva-valor {
            font-size: 13px;
        }

        .reserva-status-actions {
            gap: 8px;
        }

        .reserva-actions .btn {
            font-size: 12px;
            padding: 0.38rem 0.55rem;
        }
    }

    @media (max-width: 991px) {
        .reserva-modal-hero {
            grid-template-columns: 1fr;
        }

        .reserva-modal-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Botão para abrir o modal de Novo Usuário -->


    <!-- Modal para detalhes do cliente -->
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

    <div class="modal fade" id="modalReservaDetalhe" tabindex="-1" aria-labelledby="modalReservaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="reserva-modal-kicker" id="modalReservaKicker">Reserva</div>
                        <h4 class="modal-title mb-0" id="modalReservaLabel">Detalhes da Reserva</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="reserva-modal-hero">
                        <img src="/sem-imagem.jpg" alt="Imagem da sala" class="reserva-modal-image" id="modalReservaImagem">

                        <div class="reserva-modal-panel">
                            <div class="reserva-modal-headerline">
                                <div>
                                    <h4 class="reserva-modal-title" id="modalReservaSala">Sala</h4>
                                    <p class="reserva-modal-subtitle" id="modalReservaPeriodo">Data e horário</p>
                                </div>
                                <div id="modalReservaStatus"></div>
                            </div>

                            <div class="reserva-modal-grid">
                                <div class="reserva-detail-card">
                                    <h6>Cliente</h6>
                                    <div class="reserva-detail-line" id="modalReservaCliente"></div>
                                </div>

                                <div class="reserva-detail-card">
                                    <h6>Pagamento</h6>
                                    <div class="reserva-detail-line" id="modalReservaPagamento"></div>
                                </div>

                                <div class="reserva-detail-card">
                                    <h6>Local da reserva</h6>
                                    <div class="reserva-detail-line" id="modalReservaEndereco"></div>
                                </div>

                                <div class="reserva-detail-card">
                                    <h6>Horários reservados</h6>
                                    <ul class="reserva-hours-list" id="modalReservaHorarios"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <span class="reserva-modal-footer-note" id="modalReservaRodape">Confira os dados antes de executar qualquer ação.</span>
                    <a href="/admin/salas" class="btn btn-outline-primary" id="modalReservaSalaLink">Editar sala</a>
                    <button type="button" class="btn btn-danger cancelar-reserva" id="btnCancelarReservaModal" data-id="">Cancelar Reserva</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
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
                            <div class="reservas-toolbar-copy d-block">
                                <h3 class="mb-0">Reservas</h3>
                                <p>Visualize rapidamente cliente, período, situação e ações de cada reserva.</p>
                            </div>
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
                            <div class="reservas-filters">
                                <div class="reservas-filter">
                                    <label for="filtro-status-reserva">Status</label>
                                    <select id="filtro-status-reserva" class="form-control">
                                        <option value="">Todos</option>
                                        <option value="Confirmada">Confirmada</option>
                                        <option value="Pendente">Pendente</option>
                                        <option value="Cancelada">Cancelada</option>
                                    </select>
                                </div>
                                <div class="reservas-filter">
                                    <label for="filtro-sala-reserva">Sala</label>
                                    <select id="filtro-sala-reserva" class="form-control">
                                        <option value="">Todas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive"> 
                 
                                <table class="table user-list-table">  
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Contato</th>
                                            <th>Sala</th>
                                            <th>Data e Horário</th>
                                            <th>Status e Ações</th>
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

    <script src="@vasset('app-assets/js/scripts/pages/app-reservas-list.js')"></script>
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
