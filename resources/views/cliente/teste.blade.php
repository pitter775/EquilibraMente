
@extends('layouts.app', [
    'elementActive' => 'template'
])
@section('content')
<!-- Modal novo usuário-->
<div class="modal modal-slide-in new-template-modal fade" id="modals-slide-in">
    <div class="modal-dialog">
        <form class="add-new-template modal-content pt-0">
            @csrf 
            <input type="hidden" value="" name="id_geral" id="id_geral">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel"><span class="ediadi">Adicionar</span> Template</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="form-group">
                    <label class="form-label" for="name">Nome</label>
                    <input type="text" class="form-control dt-full-name" id="name" placeholder="Nome da Template" name="name" aria-label="Nome da Template" aria-describedby="name2" />
                </div>
                
                <button type="submit" class="btn btn-primary mr-1 data-submit add waves-effect"><i data-feather='check-circle'></i> Salvar</button>
                <button type="reset" class="btn btn-outline-secondary waves-effect" data-dismiss="modal"> <i data-feather='x'></i> Cancelar</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Fim-->
<style>
    h4{ margin-left: 18px;}
    .card-header{ margin-left: 2px;}
</style>

                
<div class="content-wrapper" data-aos=fade-left data-aos-delay=0>
    
    <div class="content-header row">
        <h4>Gerenciar Clientes</h4>
    </div>
    <div class="content-body">
        <section class="app-template-list">
            <div class="card" >
                <div class=" " style="width: 100%; padding: 10px; height: 8000px">
                teste
                </div>
            </div>
        </section>
        <!-- templates list ends -->
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">    
@endpush

@push('css_page')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-template.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
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
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>    
    <script src="../../../app-assets/js/scripts/forms/form-select2.js"></script> 
    <script src="../../../app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
    {{-- <script src="../../../app-assets/js/scripts/pages/app-template-list.js"></script> --}}
@endpush

@push('js_vendor')
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
@endpush


