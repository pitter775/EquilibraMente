@extends('layouts.app', [
    'elementActive' => 'dashboard'
])

@section('content')
@php
    $resumo = $dados['resumo'];
    $statusDistribuicao = $dados['statusDistribuicao'];
    $salasMaisReservadas = $dados['salasMaisReservadas'];
    $ocupacaoUltimos20Dias = $dados['ocupacaoUltimos20Dias'];
    $reservasPorDia = $dados['reservasPorDia'];
    $evolucaoMensal = $dados['evolucaoMensal'];
    $proximasReservas = $dados['proximasReservas'];
@endphp

<style>
    .content-wrapper,
    .content-body {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .dashboard-shell {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .dashboard-hero {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
        flex-wrap: wrap;
        padding: 12px 14px;
        border-radius: 18px;
        background:
            radial-gradient(circle at top right, rgba(127, 177, 118, 0.18), transparent 34%),
            linear-gradient(135deg, #ffffff 0%, #f5f9f2 100%);
        border: 1px solid #e8efe4;
        box-shadow: 0 12px 28px rgba(53, 84, 45, 0.06);
    }

    .dashboard-hero h2 {
        margin-bottom: 4px;
        color: #4f7e48;
        font-size: 1.45rem;
        line-height: 1.1;
    }

    .dashboard-hero p {
        margin-bottom: 0;
        color: #6f7b6c;
        max-width: 760px;
        line-height: 1.4;
        font-size: 13px;
    }

    .dashboard-kicker {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 999px;
        background: #edf6ea;
        color: #4f7e48;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 6px;
    }

    .dashboard-hero-side {
        min-width: 230px;
        border-radius: 14px;
        padding: 12px 14px;
        background: rgba(255, 255, 255, 0.76);
        border: 1px solid #ebf1e8;
    }

    .dashboard-hero-side strong {
        display: block;
        color: #355b33;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .dashboard-hero-side span {
        display: block;
        color: #6f7b6c;
        font-size: 12px;
        line-height: 1.4;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin: 0 !important;
        padding: 0 !important;
        align-items: start;
    }

    .dashboard-stat {
        border-radius: 16px;
        background: #fff;
        border: 1px solid #edf1eb;
        box-shadow: 0 10px 22px rgba(53, 84, 45, 0.05);
        padding: 10px 12px;
        min-height: 72px;
    }

    .dashboard-stat__label {
        color: #71806d;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 6px;
    }

    .dashboard-stat__value {
        color: #355b33;
        font-size: 1.15rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 4px;
    }

    .dashboard-stat__meta {
        color: #6f7b6c;
        font-size: 11px;
        line-height: 1.25;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(320px, 0.95fr);
        gap: 8px;
    }

    .dashboard-column {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .dashboard-panel {
        border-radius: 16px;
        background: #fff;
        border: 1px solid #edf1eb;
        box-shadow: 0 10px 22px rgba(53, 84, 45, 0.05);
        overflow: hidden;
    }

    .dashboard-panel__header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        padding: 10px 12px 0;
        flex-wrap: wrap;
    }

    .dashboard-panel__title {
        margin-bottom: 2px;
        color: #4f7e48;
        font-size: 0.95rem;
        font-weight: 700;
    }

    .dashboard-panel__subtitle {
        margin-bottom: 0;
        color: #7c8578;
        font-size: 11px;
        line-height: 1.35;
    }

    .dashboard-panel__body {
        padding: 8px 12px 10px;
    }

    .dashboard-mini-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        padding: 4px 8px;
        background: #f3f7f1;
        color: #4f7e48;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .dashboard-chart {
        position: relative;
        min-height: 170px;
    }

    .dashboard-chart--small {
        min-height: 132px;
    }

    .dashboard-chart canvas {
        max-height: 170px;
    }

    .dashboard-chart--small canvas {
        max-height: 132px;
    }

    .dashboard-rooms-list,
    .dashboard-upcoming-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .dashboard-room-item,
    .dashboard-upcoming-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 12px;
        background: #f9fbf8;
        border: 1px solid #eef2eb;
    }

    .dashboard-room-item strong,
    .dashboard-upcoming-item strong {
        display: block;
        color: #355b33;
        margin-bottom: 2px;
    }

    .dashboard-room-item span,
    .dashboard-upcoming-item span {
        color: #73806e;
        font-size: 11px;
        line-height: 1.3;
    }

    .dashboard-room-rank {
        min-width: 42px;
        text-align: right;
        color: #4f7e48;
        font-size: 1rem;
        font-weight: 800;
    }

    .dashboard-status-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
        margin-top: 10px;
    }

    .dashboard-status-card {
        border-radius: 12px;
        padding: 10px 12px;
        color: #fff;
    }

    .dashboard-status-card strong {
        display: block;
        font-size: 1.05rem;
        line-height: 1;
        margin-bottom: 3px;
    }

    .dashboard-status-card span {
        display: block;
        font-size: 10px;
        opacity: 0.92;
    }

    .dashboard-status-card.is-confirmada {
        background: linear-gradient(135deg, #3f8147 0%, #68a258 100%);
    }

    .dashboard-status-card.is-pendente {
        background: linear-gradient(135deg, #c29128 0%, #e0b14a 100%);
    }

    .dashboard-status-card.is-cancelada {
        background: linear-gradient(135deg, #bf5757 0%, #dc7f7f 100%);
    }

    .dashboard-empty {
        padding: 16px;
        text-align: center;
        border-radius: 12px;
        background: #f9fbf8;
        color: #7c8578;
        border: 1px dashed #dbe4d7;
        font-size: 11px;
    }

    @media (max-width: 1599px) {
        .dashboard-stats {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: minmax(0, 1.45fr) minmax(300px, 0.9fr);
        }
    }

    @media (max-width: 1279px) {
        .dashboard-stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-chart {
            min-height: 150px;
        }

        .dashboard-chart--small {
            min-height: 120px;
        }

        .dashboard-chart canvas {
            max-height: 150px;
        }

        .dashboard-chart--small canvas {
            max-height: 120px;
        }
    }

    @media (max-width: 991px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {
        .dashboard-hero {
            padding: 14px;
        }

        .dashboard-hero h2 {
            font-size: 1.25rem;
        }

        .dashboard-stats,
        .dashboard-status-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-panel__header,
        .dashboard-panel__body {
            padding-left: 12px;
            padding-right: 12px;
        }

        .dashboard-chart,
        .dashboard-chart canvas {
            min-height: 140px;
            max-height: 140px;
        }

        .dashboard-chart--small,
        .dashboard-chart--small canvas {
            min-height: 110px;
            max-height: 110px;
        }

        .dashboard-room-item,
        .dashboard-upcoming-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .dashboard-room-rank {
            text-align: left;
        }
    }
</style>

<div class="content-wrapper">
    <div class="content-body">
        <div class="dashboard-shell">
            <section class="dashboard-hero">
                <div>
                    <span class="dashboard-kicker">Painel Administrativo</span>
                    <h2>Visão geral da operação</h2>
                    <p>Acompanhe o ritmo das reservas, receita confirmada, ocupação das salas e o que precisa de atenção imediata sem depender de várias telas.</p>
                </div>
                <div class="dashboard-hero-side">
                    <strong>Leitura rápida</strong>
                    <span>{{ $resumo['reservasHoje'] }} reserva(s) hoje, {{ $resumo['pendentes'] }} pendente(s) e {{ $resumo['salasDisponiveis'] }} sala(s) disponível(is) no momento.</span>
                </div>
            </section>

            <section class="dashboard-stats">
                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Reservas Hoje</div>
                    <div class="dashboard-stat__value">{{ $resumo['reservasHoje'] }}</div>
                    <div class="dashboard-stat__meta">Compromissos previstos para o dia atual.</div>
                </article>

                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Reservas no Mês</div>
                    <div class="dashboard-stat__value">{{ $resumo['reservasMes'] }}</div>
                    <div class="dashboard-stat__meta">Total do mês atual, desconsiderando cancelamentos.</div>
                </article>

                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Receita Confirmada</div>
                    <div class="dashboard-stat__value">R$ {{ number_format($resumo['receitaConfirmadaMes'], 2, ',', '.') }}</div>
                    <div class="dashboard-stat__meta">Receita já confirmada nas reservas do mês.</div>
                </article>

                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Pendentes / Canceladas</div>
                    <div class="dashboard-stat__value">{{ $resumo['pendentes'] }} / {{ $resumo['canceladasMes'] }}</div>
                    <div class="dashboard-stat__meta">Pontos de atenção para cobrança e acompanhamento.</div>
                </article>

                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Ticket Médio Confirmado</div>
                    <div class="dashboard-stat__value">R$ {{ number_format($resumo['ticketMedio'], 2, ',', '.') }}</div>
                    <div class="dashboard-stat__meta">Média de valor das reservas efetivamente confirmadas.</div>
                </article>

                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Clientes</div>
                    <div class="dashboard-stat__value">{{ $resumo['clientes'] }}</div>
                    <div class="dashboard-stat__meta">Usuários clientes cadastrados na base.</div>
                </article>

                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Salas Disponíveis</div>
                    <div class="dashboard-stat__value">{{ $resumo['salasDisponiveis'] }}</div>
                    <div class="dashboard-stat__meta">Salas ativas para operação geral agora.</div>
                </article>

                <article class="dashboard-stat">
                    <div class="dashboard-stat__label">Status Geral</div>
                    <div class="dashboard-stat__value">{{ array_sum($statusDistribuicao) }}</div>
                    <div class="dashboard-stat__meta">Total de reservas registradas em toda a operação.</div>
                </article>
            </section>

            <section class="dashboard-grid">
                <div class="dashboard-column">
                    <article class="dashboard-panel">
                        <div class="dashboard-panel__header">
                            <div>
                                <h3 class="dashboard-panel__title">Reservas por dia no mês</h3>
                                <p class="dashboard-panel__subtitle">Mostra o ritmo diário para identificar picos e dias ociosos.</p>
                            </div>
                            <span class="dashboard-mini-badge">Mês atual</span>
                        </div>
                        <div class="dashboard-panel__body">
                            <div class="dashboard-chart">
                                <canvas id="chartReservasDia"></canvas>
                            </div>
                        </div>
                    </article>

                    <article class="dashboard-panel">
                        <div class="dashboard-panel__header">
                            <div>
                                <h3 class="dashboard-panel__title">Evolução de reservas e receita</h3>
                                <p class="dashboard-panel__subtitle">Comparativo mensal para entender crescimento e consistência da operação.</p>
                            </div>
                            <span class="dashboard-mini-badge">Últimos 6 meses</span>
                        </div>
                        <div class="dashboard-panel__body">
                            <div class="dashboard-chart">
                                <canvas id="chartEvolucaoMensal"></canvas>
                            </div>
                        </div>
                    </article>

                    <article class="dashboard-panel">
                        <div class="dashboard-panel__header">
                            <div>
                                <h3 class="dashboard-panel__title">Salas com maior demanda</h3>
                                <p class="dashboard-panel__subtitle">Ranking de reservas para enxergar rapidamente onde está a maior procura.</p>
                            </div>
                        </div>
                        <div class="dashboard-panel__body">
                            @if($salasMaisReservadas->isEmpty())
                                <div class="dashboard-empty">Nenhuma reserva suficiente para montar o ranking ainda.</div>
                            @else
                                <div class="dashboard-rooms-list">
                                    @foreach($salasMaisReservadas->take(5) as $index => $sala)
                                        <div class="dashboard-room-item">
                                            <div>
                                                <strong>{{ $sala['nome'] }}</strong>
                                                <span>{{ $sala['total'] }} reserva(s) | Receita acumulada de R$ {{ number_format($sala['receita'], 2, ',', '.') }}</span>
                                            </div>
                                            <div class="dashboard-room-rank">#{{ $index + 1 }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                </div>

                <div class="dashboard-column">
                    <article class="dashboard-panel">
                        <div class="dashboard-panel__header">
                            <div>
                                <h3 class="dashboard-panel__title">Status das reservas</h3>
                                <p class="dashboard-panel__subtitle">Distribuição geral entre confirmadas, pendentes e canceladas.</p>
                            </div>
                        </div>
                        <div class="dashboard-panel__body">
                            <div class="dashboard-chart dashboard-chart--small">
                                <canvas id="chartStatusReservas"></canvas>
                            </div>
                            <div class="dashboard-status-grid">
                                <div class="dashboard-status-card is-confirmada">
                                    <strong>{{ $statusDistribuicao['confirmada'] }}</strong>
                                    <span>Confirmadas</span>
                                </div>
                                <div class="dashboard-status-card is-pendente">
                                    <strong>{{ $statusDistribuicao['pendente'] }}</strong>
                                    <span>Pendentes</span>
                                </div>
                                <div class="dashboard-status-card is-cancelada">
                                    <strong>{{ $statusDistribuicao['cancelada'] }}</strong>
                                    <span>Canceladas</span>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="dashboard-panel">
                        <div class="dashboard-panel__header">
                            <div>
                                <h3 class="dashboard-panel__title">Ocupação nos últimos 20 dias</h3>
                                <p class="dashboard-panel__subtitle">Horas reservadas por dia para acompanhar o uso recente do espaço.</p>
                            </div>
                        </div>
                        <div class="dashboard-panel__body">
                            <div class="dashboard-chart dashboard-chart--small">
                                <canvas id="chartOcupacaoSala"></canvas>
                            </div>
                        </div>
                    </article>

                    <article class="dashboard-panel">
                        <div class="dashboard-panel__header">
                            <div>
                                <h3 class="dashboard-panel__title">Próximas reservas</h3>
                                <p class="dashboard-panel__subtitle">Ajuda a administração a antecipar atendimento, chave e suporte.</p>
                            </div>
                        </div>
                        <div class="dashboard-panel__body">
                            @if($proximasReservas->isEmpty())
                                <div class="dashboard-empty">Nenhuma reserva futura encontrada no momento.</div>
                            @else
                                <div class="dashboard-upcoming-list">
                                    @foreach($proximasReservas as $reserva)
                                        <div class="dashboard-upcoming-item">
                                            <div>
                                                <strong>{{ $reserva->usuario->name ?? 'Cliente não identificado' }}</strong>
                                                <span>{{ $reserva->sala->nome ?? 'Sala não informada' }} • {{ $reserva->data_carbono->format('d/m/Y') }} • {{ substr($reserva->hora_inicio, 0, 5) }} às {{ substr($reserva->hora_fim, 0, 5) }}</span>
                                            </div>
                                            <span class="dashboard-mini-badge">{{ ucfirst($reserva->status_normalizado) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('js_page')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const reservasPorDia = @json($reservasPorDia);
        const statusDistribuicao = @json($statusDistribuicao);
        const ocupacaoUltimos20Dias = @json($ocupacaoUltimos20Dias);
        const evolucaoMensal = @json($evolucaoMensal);

        Chart.defaults.font.family = 'Poppins, sans-serif';
        Chart.defaults.color = '#6f7b6c';

        const chartGridColor = 'rgba(96, 122, 91, 0.12)';

        new Chart(document.getElementById('chartReservasDia'), {
            type: 'line',
            data: {
                labels: reservasPorDia.map(item => item.label),
                datasets: [{
                    label: 'Reservas',
                    data: reservasPorDia.map(item => item.total),
                    borderColor: '#4f9d8a',
                    backgroundColor: 'rgba(79, 157, 138, 0.14)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 3,
                    pointRadius: 3,
                    pointHoverRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { color: chartGridColor },
                        ticks: { maxTicksLimit: 8 }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: chartGridColor },
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        new Chart(document.getElementById('chartStatusReservas'), {
            type: 'doughnut',
            data: {
                labels: ['Confirmadas', 'Pendentes', 'Canceladas'],
                datasets: [{
                    data: [
                        statusDistribuicao.confirmada,
                        statusDistribuicao.pendente,
                        statusDistribuicao.cancelada
                    ],
                    backgroundColor: ['#4f8d53', '#d6a33f', '#d46a6a'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '66%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 18
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('chartOcupacaoSala'), {
            type: 'bar',
            data: {
                labels: ocupacaoUltimos20Dias.map(item => item.label),
                datasets: [{
                    label: 'Horas reservadas',
                    data: ocupacaoUltimos20Dias.map(item => item.horas),
                    backgroundColor: '#4f7e48',
                    borderRadius: 8,
                    maxBarThickness: 24
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: chartGridColor },
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        new Chart(document.getElementById('chartEvolucaoMensal'), {
            data: {
                labels: evolucaoMensal.map(item => item.label),
                datasets: [
                    {
                        type: 'bar',
                        label: 'Receita confirmada',
                        data: evolucaoMensal.map(item => item.receita),
                        backgroundColor: 'rgba(127, 177, 118, 0.55)',
                        borderRadius: 12,
                        yAxisID: 'y1',
                        order: 2
                    },
                    {
                        type: 'line',
                        label: 'Reservas',
                        data: evolucaoMensal.map(item => item.reservas),
                        borderColor: '#4f7e48',
                        backgroundColor: '#4f7e48',
                        borderWidth: 3,
                        tension: 0.35,
                        pointRadius: 4,
                        yAxisID: 'y',
                        order: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        grid: { color: chartGridColor }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: chartGridColor },
                        ticks: { precision: 0 }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush
