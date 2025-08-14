@extends('layouts.app', [
    'elementActive' => 'minhas-reservas'
])

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12">
      <h3 class="mb-2">Minhas Reservas</h3>
    </div>
  </div>

  <div class="content-body">
    <div class="card" style="padding: 20px">
      <div class="table-responsive">
        <table class="table user-list-table">
          <thead>
            <tr>
              <th>Sala</th>
              <th>Data</th>
              <th>Horários</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($reservas as $key => $grupo)
              @php
                $reserva = $grupo->first();
                $dataReserva = \Carbon\Carbon::parse($reserva->data_reserva)->format('d/m/Y');
                $modalId = 'reservaModal_' . $reserva->id;
              @endphp

              {{-- <tr style="cursor: pointer;" data-toggle="modal" data-target="#{{ $modalId }}"> --}}
              <tr>
                <td>{{ $reserva->sala->nome }}</td>
                <td>{{ $dataReserva }}</td>
                <td>
                  @foreach($grupo as $r)
                    {{ $r->hora_inicio }} - {{ $r->hora_fim }}<br>
                  @endforeach
                </td>
                <td>
                  @php
                    $status = strtoupper($reserva->status);
                    $badge = match($status) {
                      'CONFIRMADA' => 'success',
                      'PENDENTE' => 'warning',
                      'CANCELADA' => 'danger',
                      default => 'secondary'
                    };
                  @endphp

                  <span class="badge badge-{{ $badge }} abrir-modal"
                        data-toggle="modal"
                        data-target="#{{ $modalId }}"
                        style="cursor:pointer">
                    {{ ucfirst(strtolower($status)) }}
                  </span>
                </td>
              </tr>
              

              {{-- Modal --}}
              <div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $modalId }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel{{ $modalId }}">Detalhes da Reserva</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body row">
                      <div class="col-md-5">
                        <img src="{{ $reserva->sala->imagens->first()
                            ? 'data:image/jpeg;base64,' . $reserva->sala->imagens->first()->imagem_base64
                            : asset('images/default.jpg') }}"
                            class="img-fluid rounded" style="height: 220px; object-fit: cover;">
                      </div>
                      <div class="col-md-7">
                        <h5>{{ $reserva->sala->nome }}</h5>
                        <p>
                          <strong>Endereço:</strong><br>
                          {{ $reserva->sala->endereco->rua ?? '' }},
                          {{ $reserva->sala->endereco->numero ?? '' }} -
                          {{ $reserva->sala->endereco->bairro ?? '' }}<br>
                          {{ $reserva->sala->endereco->cidade ?? '' }}/{{ $reserva->sala->endereco->estado ?? '' }}
                        </p>
                        <p><strong>Horários reservados:</strong></p>
                        <ul class="pl-3">
                          @foreach($grupo as $r)
                            <li>{{ $r->hora_inicio }} às {{ $r->hora_fim }}</li>
                          @endforeach
                        </ul>
                        @php
                            $mostrarBotao = now()->between(
                                \Carbon\Carbon::parse($reserva->data_reserva . ' ' . $grupo->min('hora_inicio'))->subMinutes(30),
                                \Carbon\Carbon::parse($reserva->data_reserva . ' ' . $grupo->max('hora_fim'))
                            );
                        @endphp

                        <div class="mt-2">
                            @if($mostrarBotao)
                                <button class="btn btn-outline-primary btn-sm ver-chave-btn"
                                        data-id="{{ $grupo->first()->id }}">
                                Ver chave da sala
                                </button>
                                <div class="chave-info mt-1 text-success font-weight-bold"></div>
                            @else
                                <p class="text-danger">A chave da sala estará visível 30 minutos antes do horário reservado.</p>
                            @endif
                        </div>

                      </div>
                    </div>
                  @php
                    // garante comparação certa
                    $status = strtoupper($status ?? $reserva->status ?? '');
                  @endphp

                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>

                    @if ($status === 'PENDENTE')
                      {{-- usa a rota do cliente que aceita GET/POST e chama pagarReserva --}}
                      <a href="{{ route('cliente.reservas.pagar', $reserva->id) }}"
                        class="btn btn-success" target="_blank">
                        Concluir pagamento
                      </a>

                      <button type="button"
                              class="btn btn-outline-danger btn-cancelar-sistema"
                              data-id="{{ $reserva->id }}">
                        Cancelar (sistema)
                      </button>

                    @elseif (in_array($status, ['PAGA','CONFIRMADA']))
                      <a href="https://wa.me/5511979691269?text=Ol%C3%A1!%20Quero%20cancelar%20a%20reserva%20%23{{ $reserva->id }}."
                        target="_blank"
                        class="btn btn-danger">
                        Cancelar via WhatsApp
                      </a>
                    @endif
                  </div>

                    </div>
                  </div>
                </div>
              </div>
              {{-- Fim Modal --}}

            @endforeach
          </tbody>
        </table>
      </div>
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

        $(document).on('click', '.ver-chave-btn', function () {
            let reservaId = $(this).data('id');
            let $btn = $(this);
            let $info = $btn.closest('.mt-2').find('.chave-info');

            $.ajax({
                url: `/cliente/reserva/${reservaId}/chave`,
                method: 'GET',
                success: function (res) {
                    $btn.hide();
                    $info.text(`Sua chave de acesso: ${res.chave}`);
                },
                error: function (xhr) {
                    $info.text(xhr.responseJSON.error || 'Erro ao buscar chave.')
                        .addClass('text-danger');
                }
            });
        });

        // cancelar no sistema (só PENDENTE)
        $(document).on('click', '.btn-cancelar-sistema', function () {
          const id = $(this).data('id');
          const ref = 'reserva_' + id;
          $.ajax({
            url: '/reserva/cancelar',
            method: 'POST',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
              reference_id: ref
            },
            success: function () {
              // simples e efetivo: recarrega lista já atualizada
              location.reload();
            },
            error: function (xhr) {
              alert(xhr.responseJSON?.message || 'Falha ao cancelar a reserva.');
            }
          });
        });

 $(document).on('click', '.btn-modal-pagar', async function () {
    const id = $(this).data('id');
    const $btn = $(this);
    $btn.prop('disabled', true).text('Gerando link...');
    try {
      const r = await fetch(`/cliente/reservas/${id}/pagar`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Accept': 'application/json'
        }
      });
      const j = await r.json();
      if (j && j.redirect) {
        window.location.href = j.redirect;
      } else {
        toastr.error(j?.message ?? 'Erro ao gerar link de pagamento.');
        $btn.prop('disabled', false).text('Concluir pagamento');
      }
    } catch (e) {
      toastr.error('Falha ao iniciar pagamento.');
      $btn.prop('disabled', false).text('Concluir pagamento');
    }
  });

  // cancelar (na modal)
  $(document).on('click', '.btn-modal-cancelar', async function () {
    const id = $(this).data('id');
    if (!confirm('Tem certeza que deseja cancelar esta reserva?')) return;

    const $btn = $(this);
    $btn.prop('disabled', true).text('Cancelando...');
    try {
      const r = await fetch(`/cliente/reservas/${id}/cancelar`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Accept': 'application/json'
        }
      });
      const j = await r.json();
      if (j?.success) {
        toastr.success('Reserva cancelada.');
        location.reload();
      } else {
        toastr.error(j?.message ?? 'Não foi possível cancelar.');
        $btn.prop('disabled', false).text('Cancelar');
      }
    } catch (e) {
      toastr.error('Falha ao cancelar.');
      $btn.prop('disabled', false).text('Cancelar');
    }
  });
</script>

@endpush
