@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Editar Contrato</h3>

    <form action="{{ route('admin.contrato.salvar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="versao">Versão do Contrato</label>
            <input type="text" class="form-control" id="versao" name="versao" value="{{ old('versao', $contrato->versao ?? '') }}">
        </div>

        <div class="form-group mt-3">
            <label for="conteudo">Conteúdo do Contrato</label>
            <textarea class="form-control" id="conteudo" name="conteudo" rows="15">{{ old('conteudo', $contrato->conteudo ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Salvar Contrato</button>
    </form>
</div>
@endsection
