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
              <th class="text-right">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach($reservas as $key => $grupo)
              @php
                $reserva = $grupo->first();
                $dataReserva = \Carbon\Carbon::parse($reserva->data_reserva)->format('d/m/Y');
                $modalId = 'reservaModal_' . $reserva->id;
              @endphp

              <tr style="cursor: pointer;" data-toggle="modal" data-target="#{{ $modalId }}">
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

                  <span class="badge badge-{{ $badge }}">{{ ucfirst(strtolower($status)) }}</span>
                </td>
                <!-- TD da linha -->
                <td class="text-right">
                  @if(strtolower($reserva->status) === 'pendente')
                    <button
                      class="btn btn-sm btn-success btn-pagar"
                      data-id="{{ $reserva->id }}">
                      Concluir pagamento
                    </button>

                    <button
                      class="btn btn-sm btn-outline-danger btn-cancelar"
                      data-id="{{ $reserva->id }}">
                      Cancelar
                    </button>
                  @else
                    —
                  @endif
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
                        <img src="{{ $reserva->sala->imagens->first()?->imagem_base64 ?? 'default.jpg' }}" class="img-fluid rounded" style="height: 220px; object-fit: cover;">
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
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                      <a href="https://wa.me/5511979691269?text=Olá,%20gostaria%20de%20cancelar%20minha%20reserva." target="_blank" class="btn btn-danger">
                        Cancelar via WhatsApp
                      </a>
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

document.addEventListener('click', async (e) => {
  // pagar
  if (e.target.closest('.btn-pagar')) {
    const id = e.target.closest('.btn-pagar').dataset.id;
    try {
      const r = await fetch(`/cliente/reservas/${id}/pagar`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const json = await r.json();

      if (json?.redirect) {
        window.location.href = json.redirect; // abre o link do MP
      } else {
        toastr.error(json?.message ?? 'Erro ao gerar link de pagamento.');
      }
    } catch (err) {
      toastr.error('Falha ao iniciar pagamento.');
    }
  }

  // cancelar
  if (e.target.closest('.btn-cancelar')) {
    const id = e.target.closest('.btn-cancelar').dataset.id;
    if (!confirm('Tem certeza que deseja cancelar esta reserva?')) return;

    try {
      const r = await fetch(`/cliente/reservas/${id}/cancelar`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const json = await r.json();

      if (json?.success) {
        toastr.success('Reserva cancelada com sucesso.');
        // recarrega a tabela/lista
        window.location.reload();
      } else {
        toastr.error(json?.message ?? 'Não foi possível cancelar.');
      }
    } catch (err) {
      toastr.error('Falha ao cancelar reserva.');
    }
  }
});
</script>

@endpush
