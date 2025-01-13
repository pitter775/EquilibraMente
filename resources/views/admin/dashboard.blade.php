
@extends('layouts.app', [
    'elementActive' => 'dashboard'
])
@section('content')

<style>
    h4{ margin-left: 18px;}
    .card-header{ margin-left: 2px;}
</style>

                
<div class="content-wrapper">
    
    <div class="content-header row">
        <h4>Dashboard Administrativo em Construção</h4>
    </div>
    <div class="content-body">
        <section class="app-template-list">
            <div class="row">
                <!-- Total de Reservas -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Total de Reservas</h5>
                            <p>{{ $dados['totalReservas'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Receita Estimada -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Receita Estimada</h5>
                            <p>R$ {{ number_format($dados['receitaEstimada'], 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Reservas Ativas e Concluídas -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Reservas Ativas</h5>
                            <p>{{ $dados['reservasAtivas'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Reservas Concluídas</h5>
                            <p>{{ $dados['reservasConcluidas'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Salas Mais Reservadas -->
                <div class="col-md-6">
                    <h5>Salas Mais Reservadas</h5>
                    <ul>
                        @foreach ($dados['salasMaisReservadas'] as $sala)
                            <li>{{ $sala->nome }} - {{ $sala->reservas_count }} reservas</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Ocupação por Sala -->
                <div class="col-md-6">
                    <h5>Taxa de Ocupação das Salas</h5>
                    <ul>
                        @foreach ($dados['taxaOcupacaoSalas'] as $sala)
                            <li>{{ $sala['nome'] }} - {{ $sala['taxa_ocupacao'] }} reservas ativas</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Gráfico de Reservas por Dia -->
                <div class="col-md-12">
                    <h5>Reservas ao Longo do Tempo (Mês Atual)</h5>
                    <canvas id="reservasPorDiaChart"></canvas>
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
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-alocacao.css"> --}}
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
    {{-- <script src="../../../app-assets/js/scripts/pages/app-alocacao-list.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfico de Reservas por Dia do Mês
        const ctx = document.getElementById('reservasPorDiaChart').getContext('2d');
        const reservasPorDiaData = @json($dados['reservasPorDia']);
        
        const labels = reservasPorDiaData.map(item => item.data);
        const data = reservasPorDiaData.map(item => item.total);

        const reservasPorDiaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Reservas',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: true, title: { display: true, text: 'Data' }},
                    y: { display: true, title: { display: true, text: 'Total de Reservas' }}
                }
            }
        });
    </script>
@endpush

@push('js_vendor')
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
@endpush


