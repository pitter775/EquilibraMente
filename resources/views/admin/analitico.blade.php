
@extends('layouts.app', [
    'elementActive' => 'analitico'
])
@section('content')

<style>
    h4{ margin-left: 18px;}
    .card-header{ margin-left: 2px;}
</style>

                
<div class="content-wrapper">
    
    <div class="content-header row">
        <h4>Acessar os dados do Google Analítico.</h4>
    </div>
   <div class="content-body">
      <div class="card" style="padding: 20px">
         <p>
                  Para acessar o Google Analytics, clique no botão abaixo e faça login com as credenciais fornecidas.
         </p>
         <p><strong>Usuário:</strong> espacoequilibramente7@gmail.com</p>
         <p><strong>Senha:</strong> q1w2e3r4m</p>
         <a href="https://analytics.google.com/analytics/web/#/p473689702/reports/dashboard?params=_u..nav%3Dmaui%26_r.1..selmet%3D%5B%22conversions%22%5D&r=business-objectives-generate-leads-overview&ruid=business-objectives-generate-leads-overview,business-objectives,generate-leads&collectionId=business-objectives" target="_blank" class="btn btn-primary small col-2">
                  Acessar Google Analytics
         </a>
      </div>
   </div>
</div>
@endsection

@push('css_vendor')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">   
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">    
@endpush

@push('css_page')
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-alocacao.css"> --}}
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
@endpush

@push('js_page')
    <script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>    
    <script src="../../../app-assets/js/scripts/forms/form-select2.js"></script> 
    <script src="../../../app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
@endpush

@push('js_vendor')
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
@endpush


