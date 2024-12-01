@extends('layouts.app', [
    'elementActive' => 'minhas-reservas'
])

@section('content')
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
    
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h3 class="float-left mb-0">Minhas Reservas</h3>
                    
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
                                                <th>Sala</th>
                                                <th>Período</th>
                                                <th>Valor por Hora</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reservas as $reserva)
                                                <tr>
                                                    <td>{{ $reserva->sala->nome }}</td>
                                                    <td>
                                                        <i data-feather='calendar'></i> {{ \Carbon\Carbon::parse($reserva->data_reserva)->format('d/m/Y') }}<br>
                                                        <i data-feather='clock'></i> {{ $reserva->hora_inicio }} - {{ $reserva->hora_fim }}
                                                    </td>
                                                    <td>R$ {{ number_format($reserva->sala->valor, 2, ',', '.') }}</td>
                                                    <td>
                                                        @php
                                                            $agora = now(); // Hora atual
                                                            $inicio = \Carbon\Carbon::parse($reserva->data_reserva . ' ' . $reserva->hora_inicio); // Início da reserva
                                                            $fim = \Carbon\Carbon::parse($reserva->data_reserva . ' ' . $reserva->hora_fim); // Fim da reserva

                                                        @endphp

                                                        @if($agora->lt($inicio))
                                                            <span class="badge badge-warning">Reservado</span>
                                                        @elseif($agora->between($inicio, $fim))
                                                            <span class="badge badge-success">Em andamento</span>
                                                        @else
                                                            <span class="badge badge-secondary">Concluído</span>
                                                        @endif




                                                    </td>
                                                </tr>
                                            @endforeach
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
@endpush

@push('js_vendor')
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
@endpush

@push('js_page')
<script>
    $(document).ready(function () {
        $('.user-list-table').DataTable({
            responsive: true,
            autoWidth: false,
                language: {
                    url: datatablesLangUrl
                }
        });
    });
</script>
@endpush
