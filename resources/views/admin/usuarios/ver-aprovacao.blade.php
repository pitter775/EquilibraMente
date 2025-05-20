@extends('layouts.site-interna', [
    'elementActive' => 'usuarios'
])

@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 100px">
    <div class="card p-4">
        <h4 class="mb-4"><i class="fas fa-user-check"></i> Revisar Cadastro</h4>

        <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <p><strong>Nome:</strong> {{ $user->name }} 
                <strong class="pl-2">Email:</strong> {{ $user->email }}
                <strong  class="pl-2" >Documento:</strong> {{ $user->documento_tipo }}
                </p>
            </div>
        </div>

        @if($user->documento_identidade)
            @if(Str::endsWith($user->documento_identidade, ['jpg', 'jpeg', 'png']))
                <img src="{{ route('documento.ver', ['nome' => $user->documento_identidade]) }}" class="img-fluid mb-4" style="max-width: 100%; max-height: 400px;">
            @else
                <a href="{{ route('documento.ver', ['nome' => $user->documento_identidade]) }}" target="_blank" class="btn btn-info mb-3">
                    <i class="fas fa-file-download"></i> Visualizar Documento
                </a>
            @endif
        @endif

        @if($user->documento_caminho)
            <div class="mb-4">
                <p><strong>Documento Enviado:</strong></p>
                <a href="{{ URL::signedRoute('documento.ver', ['user' => $user->id]) }}" target="_blank">
                  <img src="{{ URL::signedRoute('documento.ver', ['user' => $user->id]) }}" alt="Documento" class="img-fluid rounded" style="max-width: 100%; max-height: 400px;">
                </a>
            </div>
        @endif

        <div class="d-flex justify-content-start gap-3">
            <form method="POST" action="{{ route('admin.usuario.aprovar', $user->id) }}" class="mr-2">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Aprovar
                </button>
            </form>

            <form method="POST" action="{{ route('admin.usuario.reprovar', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-times-circle"></i> Reprovar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection