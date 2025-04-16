
@extends('layouts.app', [
    'elementActive' => 'fechadura'
])

@section('content')
<style>
  h4 { margin-left: 18px; }
  .card-header { margin-left: 2px; }
  .cardsalas { border: solid 1px #cccc; margin-bottom: 40px; padding: 30px }
  .imagemsala{ width: 40%; position: relative; }
  .inputssala{ width: 50%;}

  @media (max-width: 968px) {
  .imagemsala{ display:none}
  .inputssala{ width: 100%;}
  }
</style>

<div class="content-wrapper">
  <div class="content-header row">
    <h4>Gerenciar fechaduras das salas.</h4>
  </div>

  <div class="content-body">
    <div class="card" style="padding: 40px">
      <div class="row match-height">

        @foreach($salas as $sala)
          @php
            $fechadura = $sala->fechadura;
            $chaves = is_array($fechadura?->chaves) ? $fechadura->chaves : [];
            $imagem = $sala->imagens->first();
          @endphp

          <div class="col-md-6">
            <div class="cardsalas">
              <h5>{{ $sala->nome }}</h5>

              <form method="POST" action="{{ route('fechaduras.update', $sala->id) }}">
                @csrf
                @method('PUT')

                <div class="card-body d-flex" style="padding: 0">
                  
                  {{-- Imagem --}}
                  <div class="me-2 mr-3 imagemsala" style="">
                    <img src="{{ $imagem->imagem_base64 ?? '' }}" class="img-fluid rounded" style="height: 180px; object-fit: cover;">
                  </div>

                  {{-- Dados da fechadura --}}
                  <div style="" class="d-flex flex-column justify-content-center ps-2 inputssala">
                    @for ($i = 0; $i < 4; $i++)
                        @php
                            $chaveAtual = $chaves[$i] ?? '';
                            $bloqueada = in_array($chaveAtual, $chavesBloqueadas);
                        @endphp

                        <div class="d-flex align-items-center mb-1">
                            <i data-feather='lock'></i>
                            <input
                                type="text"
                                class="form-control form-control-sm mx-1 chave-input"
                                name="chaves[]"
                                value="{{ $chaveAtual }}"
                                maxlength="12"
                                {{ $bloqueada ? 'readonly' : '' }}
                            >
                            
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger limpar-btn"
                                    title="{{ $bloqueada ? 'Chave em uso' : 'Limpar' }}"
                                    {{ $bloqueada ? 'disabled' : '' }}>
                                <i data-feather="{{ $bloqueada ? 'alert-triangle' : 'x' }}"></i>
                            </button>
                        </div>
                    @endfor

                  </div>
                </div>

                <hr>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                    Atualizar
                  </button>
                </div>
              </form>
            </div>
          </div>

        @endforeach

      </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.limpar-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const input = this.closest('.d-flex').querySelector('.chave-input');
                if (input) input.value = '';
            });
            });
        });
    </script>
@endpush

@push('js_vendor')
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
@endpush


