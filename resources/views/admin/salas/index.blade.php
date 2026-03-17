@extends('layouts.app', [
    'elementActive' => 'salas'
])
@section('content')

<style>
    #conveniencias-container .form-check {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(180deg, #ffffff 0%, #f7faf5 100%);
        border: 1px solid #e4ece0;
        border-radius: 14px;
        box-shadow: 0 8px 16px rgba(56, 83, 47, 0.08);
        padding: 11px 14px 11px 12px;
        margin-bottom: 10px;
        margin-right: 10px;
        transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease, background 0.18s ease;
    }

    #conveniencias-container .form-check:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 20px rgba(56, 83, 47, 0.12);
        border-color: #cfe0c8;
    }

    #conveniencias-container .form-check-input {
        appearance: none;
        -webkit-appearance: none;
        width: 19px;
        height: 19px;
        min-width: 19px;
        border-radius: 6px;
        border: 1.5px solid #b9c8b3;
        background: #fff;
        margin: 0;
        cursor: pointer;
        position: relative;
        transition: all 0.18s ease;
    }

    #conveniencias-container .form-check-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-left: 10px;
        margin-top: 0;
        margin-bottom: 0;
        cursor: pointer;
        color: #56824f;
        font-weight: 500;
    }

    #conveniencias-container .form-check-label i {
        font-size: 17px;
        color: #7c8a77;
        transition: color 0.18s ease;
    }

    .form-check-input {
        margin-left: 0;
    }

    #conveniencias-container .form-check-input:hover {
        border-color: #7ea86f;
        box-shadow: 0 0 0 4px rgba(127, 177, 118, 0.12);
    }

    #conveniencias-container .form-check-input:checked {
        background-color: #4f7e48;
        border-color: #4f7e48;
        box-shadow: 0 0 0 4px rgba(127, 177, 118, 0.16);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2.2' d='M3.2 8.2l2.8 2.9 6-6.2'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 12px 12px;
    }

    #conveniencias-container .form-check-input:checked + .form-check-label {
        color: #355b33;
    }

    #conveniencias-container .form-check-input:checked + .form-check-label i {
        color: #4f7e48;
    }

    #conveniencias-container .form-check:has(.form-check-input:checked) {
        background: linear-gradient(180deg, #f7fbf5 0%, #edf6ea 100%);
        border-color: #cfe0c8;
        box-shadow: 0 12px 22px rgba(79, 126, 72, 0.12);
    }

    .section-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 999px;
        background: #edf6ea;
        color: #4f7e48;
        font-size: 12px;
        font-weight: 600;
    }

    .section-help {
        color: #7c8578;
        font-size: 13px;
        margin-bottom: 0;
    }

    .section-help-strong {
        color: #5b6755;
        font-size: 13px;
        margin-top: 6px;
        margin-bottom: 0;
        font-weight: 600;
    }

    .bloqueio-empty {
        border: 1px dashed #d7ded4;
        border-radius: 12px;
        padding: 18px;
        text-align: center;
        color: #7c8578;
        background: #fafcf9;
    }

    .bloqueio-item {
        border: 1px solid #edf1eb;
        border-radius: 12px;
        padding: 12px 14px;
        background: #fff;
        margin-bottom: 10px;
        box-shadow: 0 4px 14px rgba(44, 62, 36, 0.04);
    }

    .bloqueio-item strong {
        color: #4f7e48;
    }

    .bloqueio-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
    }

    .bloqueio-main {
        min-width: 0;
        flex: 1;
    }

    .bloqueio-head {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 4px;
    }

    .bloqueio-tipo {
        font-size: 14px;
        line-height: 1.2;
    }

    .bloqueio-periodo {
        color: #5c6758;
        font-size: 13px;
        font-weight: 600;
    }

    .bloqueio-meta {
        color: #7c8578;
        font-size: 13px;
    }

    .bloqueio-motivo {
        margin-top: 7px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        max-width: 100%;
        padding: 6px 10px;
        border-radius: 999px;
        background: #f4f7f2;
        color: #5b6755;
        font-size: 12px;
        line-height: 1.3;
    }

    .bloqueio-motivo strong {
        color: #4f7e48;
        font-size: 12px;
    }

    .bloqueio-actions {
        display: flex;
        flex-shrink: 0;
    }

    .bloqueio-actions .btn {
        white-space: nowrap;
    }

    #lista-bloqueios-sala {
        max-height: 420px;
        overflow-y: auto;
        padding-right: 4px;
    }

    @media (max-width: 767px) {
        .bloqueio-row {
            flex-direction: column;
        }

        .bloqueio-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }

    #modals-slide-in .modal-dialog {
        max-width: 1180px;
        margin: 1.75rem auto;
    }

    #modals-slide-in .modal-content {
        border-radius: 18px;
        overflow: visible;
    }

    #modals-slide-in .modal-body {
        max-height: calc(100vh - 220px);
        overflow-y: auto;
        padding-top: 0;
    }

    #modals-slide-in .modal-header,
    #modals-slide-in .modal-footer {
        position: relative;
        z-index: 3;
        background: #fff;
    }

    #modals-slide-in .modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding-right: 1.5rem;
    }

    #modals-slide-in .modal-header .close {
        margin: 0;
        padding: 0.25rem;
        line-height: 1;
        opacity: 1;
        flex-shrink: 0;
    }

    .sala-modal-header-copy {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
        min-width: 0;
        flex: 1;
    }

    .sala-modal-heading {
        display: block;
        width: 100%;
    }

    .sala-modal-heading .modal-title {
        margin-bottom: 0;
        line-height: 1.15;
    }

    .sala-modal-header-side {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        margin-left: auto;
    }

    .sala-modal-contexto {
        display: inline-flex;
        align-items: center;
        padding: 7px 12px;
        border-radius: 999px;
        background: #edf6ea;
        color: #4f7e48;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        white-space: nowrap;
    }

    .sala-modal-contexto.d-none {
        display: none !important;
    }

    .sala-tabs {
        border-bottom: 1px solid #edf1eb;
        margin: 0 -1rem 1.5rem;
        padding: 0 1rem;
        position: sticky;
        top: 0;
        z-index: 2;
        background: #fff;
    }

    .sala-tabs .nav-link {
        border: 0;
        color: #6c757d;
        border-bottom: 2px solid transparent;
        border-radius: 0;
        padding: 14px 16px;
        font-weight: 600;
    }

    .sala-tabs .nav-link.active {
        color: #4f7e48;
        background: transparent;
        border-bottom-color: #78a96f;
    }

    .sala-tab-pane {
        padding: 6px 4px 8px;
    }

    .sala-block {
        background: #fff;
        border: 1px solid #eef2eb;
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 18px;
        box-shadow: 0 10px 24px rgba(61, 101, 54, 0.05);
    }

    .sala-block-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 18px;
    }

    .sala-block-header h3 {
        margin-bottom: 4px;
    }

    .status-overview {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(280px, 0.95fr);
        gap: 16px;
        margin-bottom: 18px;
    }

    .status-overview-card,
    .status-guidance-card {
        border-radius: 16px;
        padding: 16px 18px;
    }

    .status-overview-card {
        border: 1px solid #e6ede2;
        background: linear-gradient(180deg, #fbfdf9 0%, #f2f7ef 100%);
    }

    .status-overview-label {
        display: block;
        color: #7c8578;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 10px;
    }

    .status-overview-main {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }

    .status-overview-copy {
        min-width: 0;
    }

    .status-overview-title {
        margin: 0;
        color: #355b33;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .status-overview-subtitle {
        margin: 6px 0 0;
        color: #6f7b6c;
        font-size: 13px;
        line-height: 1.5;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 10px 16px;
        font-weight: 800;
        font-size: 13px;
        letter-spacing: 0.01em;
        white-space: nowrap;
        border: 1px solid transparent;
    }

    .status-pill.is-disponivel {
        background: #edf7ea;
        color: #3f7c34;
        border-color: #dcecd6;
    }

    .status-pill.is-indisponivel {
        background: #fff1f1;
        color: #c25757;
        border-color: #f6d7d7;
    }

    .status-guidance-card {
        border: 1px solid #eef2eb;
        background: #fff;
    }

    .status-guidance-title {
        color: #4f7e48;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .status-guidance-text {
        color: #6f7b6c;
        font-size: 13px;
        line-height: 1.55;
        margin-bottom: 0;
    }

    .status-field-wrap {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .status-helper-inline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #6f7b6c;
        font-size: 12px;
        line-height: 1.45;
    }

    .status-helper-inline strong {
        color: #4f7e48;
    }

    .imagem-card {
        border: 1px solid #e8eee4;
        border-radius: 16px;
        background: #fff;
        overflow: hidden;
        box-shadow: 0 8px 22px rgba(44, 62, 36, 0.05);
    }

    .imagem-preview-wrap {
        position: relative;
        background: linear-gradient(180deg, #f7faf6 0%, #eff5ed 100%);
        padding: 12px;
    }

    .imagem-preview {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
    }

    .imagem-badge-principal {
        position: absolute;
        top: 20px;
        left: 20px;
        display: none;
        background: rgba(53, 95, 45, 0.95);
        color: #fff;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .imagem-card.is-principal {
        border-color: #7fb176;
        box-shadow: 0 12px 28px rgba(71, 117, 61, 0.16);
    }

    .imagem-card.is-principal .imagem-badge-principal {
        display: inline-flex;
    }

    .imagem-card-body {
        padding: 14px;
    }

    .imagem-card-title {
        font-weight: 700;
        color: #4f7e48;
        margin-bottom: 10px;
    }

    .imagem-card-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .salas-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .salas-toolbar-copy h3 {
        margin-bottom: 6px;
        color: #4f7e48;
    }

    .salas-toolbar-copy p {
        margin-bottom: 0;
        color: #7c8578;
    }

    .salas-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .salas-search {
        position: relative;
        margin-bottom: 26px;
    }

    .salas-search .form-control {
        height: 58px;
        border-radius: 18px;
        border: 1px solid #e7ece4;
        padding-left: 52px;
        box-shadow: 0 10px 24px rgba(61, 101, 54, 0.05);
        background: #fff;
    }

    .salas-search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa59a;
        pointer-events: none;
    }

    #ecommerce-products {
        display: flex;
        flex-wrap: wrap;
        gap: 22px;
        align-items: stretch;
    }

    .sala-card {
        background: #fff;
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid #edf1eb;
        box-shadow: 0 18px 40px rgba(47, 73, 41, 0.08);
        display: flex;
        flex-direction: column;
        min-height: 100%;
        width: min(100%, 320px);
        max-width: 320px;
        flex: 1 1 300px;
    }

    .sala-card-media {
        position: relative;
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: linear-gradient(180deg, #eef4ec 0%, #f8faf7 100%);
    }

    .sala-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .sala-card-price {
        position: absolute;
        right: 16px;
        bottom: 16px;
        background: rgba(255, 255, 255, 0.94);
        color: #4f7e48;
        border-radius: 999px;
        padding: 8px 12px;
        font-weight: 700;
        box-shadow: 0 8px 22px rgba(38, 59, 33, 0.12);
    }

    .sala-card-body {
        padding: 18px 18px 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .sala-card-topline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .sala-card-status {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: #edf6ea;
        color: #4f7e48;
        font-size: 12px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .sala-card-status.is-indisponivel {
        background: #fff0f0;
        color: #c25757;
    }

    .sala-card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #495057;
        margin-bottom: 0;
    }

    .sala-card-meta {
        color: #7a8377;
        font-size: 0.95rem;
    }

    .sala-card-description {
        color: #5d645b;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .sala-card-footer {
        padding: 0 18px 18px;
    }

    .sala-card-footer .btn {
        border-radius: 14px;
        padding: 12px 16px;
        font-weight: 700;
    }

    @media (max-width: 1500px) {
        #ecommerce-products {
            gap: 16px;
        }

        .sala-card {
            width: min(100%, 290px);
            max-width: 290px;
            flex-basis: 290px;
        }

        .sala-card-body {
            padding: 14px 14px 12px;
        }

        .sala-card-footer {
            padding: 0 14px 14px;
        }

        .sala-card-description {
            font-size: 13px;
            line-height: 1.45;
        }
    }

    @media (max-width: 767px) {
        #ecommerce-products {
            display: block;
        }

        .sala-card {
            max-width: none;
            width: 100%;
            flex: none;
            margin-bottom: 22px;
        }

        .status-overview {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="modal fade text-left" id="modals-slide-in">
    <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="sala-modal-header-copy">
                        <div class="sala-modal-heading">
                            <h4 class="modal-title" id="myModalLabel17" style="margin-left: 0px">Adicionar Nova Sala</h4>
                        </div>
                        <small class="text-muted d-block" id="modal-subtitle-sala">Cadastre uma nova sala com seus dados principais.</small>
                    </div>
                    <div class="sala-modal-header-side">
                        <span class="sala-modal-contexto d-none" id="modal-sala-contexto"></span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
            </div>

            <form class="add-new-sala pt-0" method="POST" id="add-new-sala-form" enctype="multipart/form-data" action="{{ route('salas.store') }}" data-action-store="{{ route('salas.store') }}">
                @csrf

                <div class="modal-body">
                    <ul class="nav nav-tabs sala-tabs" id="salaModalTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-dados-link" data-toggle="tab" href="#tab-dados" role="tab">Dados da sala</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-midia-link" data-toggle="tab" href="#tab-midia" role="tab">Estrutura e mídia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-agenda-link" data-toggle="tab" href="#tab-agenda" role="tab">Agenda e bloqueios</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active sala-tab-pane" id="tab-dados" role="tabpanel">
                            <div class="sala-block">
                                <div class="sala-block-header">
                                    <div>
                                        <h3 class="mt-0">Dados iniciais</h3>
                                        <p class="section-help">Informações principais para cadastro e organização da sala.</p>
                                        <p class="section-help-strong">Use a aba "Agenda e bloqueios" para controlar datas e horários, não este status.</p>
                                    </div>
                                    <span class="section-badge">Cadastro base</span>
                                </div>

                                <div class="status-overview">
                                    <div class="status-overview-card">
                                        <span class="status-overview-label">Leitura rápida</span>
                                        <div class="status-overview-main">
                                            <div class="status-overview-copy">
                                                <p class="status-overview-title">Status geral da sala</p>
                                                <p class="status-overview-subtitle">Este campo representa a situação global da sala. A agenda tem controle separado.</p>
                                            </div>
                                            <span class="status-pill is-disponivel" id="status-geral-badge">Disponível</span>
                                        </div>
                                    </div>
                                    <div class="status-guidance-card">
                                        <div class="status-guidance-title">Quando usar</div>
                                        <p class="status-guidance-text">Status geral serve para ativar ou desativar a sala como um todo. Para bloquear um dia, um período ou uma manutenção pontual, use Agenda e bloqueios.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-7 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="status">Status geral da sala</label>
                                            <div class="status-field-wrap">
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="disponivel">Disponível para operação</option>
                                                    <option value="indisponivel">Indisponível no geral</option>
                                                </select>
                                                <span class="status-helper-inline">
                                                    <strong>Importante:</strong> bloqueios de agenda não devem ser feitos aqui.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" placeholder="Nome da Sala" name="nome" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="metragem">Metragem</label>
                                            <input type="text" class="form-control" id="metragem" placeholder="Metragem da Sala" name="metragem" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-0">
                                            <label class="form-label" for="valor">Valor R$ por hora</label>
                                            <input type="text" class="form-control" id="valor" placeholder="Valor Diária" name="valor" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sala-block">
                                <div class="sala-block-header">
                                    <div>
                                        <h3 class="mt-0">Endereço</h3>
                                        <p class="section-help">Dados fixos de localização usados no cadastro da sala.</p>
                                    </div>
                                    <span class="section-badge">Localização</span>
                                </div>

                                <div id="novo-endereco-form">
                                    <div class="row">
                                        <div class="col-md-3 mb-1">
                                            <label for="endereco_cep" class="form-label">CEP</label>
                                            <input type="text" class="form-control" id="endereco_cep" name="endereco[cep]">
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label for="endereco_rua" class="form-label">Rua</label>
                                            <input type="text" class="form-control" id="endereco_rua" name="endereco[rua]">
                                        </div>
                                        <div class="col-md-3 mb-1">
                                            <label for="endereco_numero" class="form-label">Número</label>
                                            <input type="text" class="form-control" id="endereco_numero" name="endereco[numero]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-1">
                                            <label for="endereco_complemento" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="endereco_complemento" name="endereco[complemento]">
                                        </div>
                                        <div class="col-md-3 mb-1">
                                            <label for="endereco_bairro" class="form-label">Bairro</label>
                                            <input type="text" class="form-control" id="endereco_bairro" name="endereco[bairro]">
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label for="endereco_cidade" class="form-label">Cidade</label>
                                            <input type="text" class="form-control" id="endereco_cidade" name="endereco[cidade]">
                                        </div>
                                        <div class="col-md-2 mb-1">
                                            <label for="endereco_estado" class="form-label">Estado</label>
                                            <input type="text" class="form-control" id="endereco_estado" name="endereco[estado]">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sala-block">
                                <div class="sala-block-header">
                                    <div>
                                        <h3 class="mt-0">Descrição</h3>
                                        <p class="section-help">Texto usado no site e nos detalhes da sala.</p>
                                    </div>
                                    <span class="section-badge">Conteúdo</span>
                                </div>

                                <div class="form-group mb-0">
                                    <div id="descricao_quill"></div>
                                    <textarea class="form-control" id="descricao" name="descricao" style="display: none;"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade sala-tab-pane" id="tab-midia" role="tabpanel">
                            <div class="sala-block">
                                <div class="sala-block-header">
                                    <div>
                                        <h3 class="mt-0">Conveniências</h3>
                                        <p class="section-help">Selecione os diferenciais que ajudam a apresentar melhor a sala.</p>
                                    </div>
                                    <span class="section-badge">Experiência</span>
                                </div>

                                <div id="conveniencias-container" class="d-flex flex-wrap">
                                    @foreach ($conveniencias as $conveniencia)
                                        <div class="form-check me-3 mr-3 mt-1">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="conveniencia_{{ $conveniencia->id }}"
                                                name="conveniencias[]"
                                                value="{{ $conveniencia->id }}"
                                                @if(isset($sala) && $sala->conveniencias->contains($conveniencia->id)) checked @endif
                                            >
                                            <label class="form-check-label" for="conveniencia_{{ $conveniencia->id }}">
                                                <i class="{{ $conveniencia->icone }}"></i> {{ $conveniencia->nome }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="sala-block">
                                <div class="sala-block-header">
                                    <div>
                                        <h3 class="mt-0">Imagens</h3>
                                        <p class="section-help">Adicione fotos e escolha com clareza qual será a imagem principal.</p>
                                    </div>
                                    <span class="section-badge">Galeria</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="imagens">Novas imagens da sala</label>
                                    <input type="file" name="imagens[]" id="imagens" multiple class="form-control" accept="image/*">
                                </div>

                                <div id="imagens-existentes" class="row mt-2"></div>
                            </div>
                        </div>

                        <div class="tab-pane fade sala-tab-pane" id="tab-agenda" role="tabpanel">
                            <div class="sala-block">
                                <div class="sala-block-header">
                                    <div>
                                        <h3 class="mt-0">Bloqueios da agenda</h3>
                                        <p class="section-help">Bloqueie dias inteiros ou intervalos específicos sem criar reservas fictícias.</p>
                                    </div>
                                    <span class="section-badge">Operacional</span>
                                </div>

                                <div id="bloqueio-sala-alerta" class="alert alert-light">
                                    Abra uma sala existente para cadastrar ou remover bloqueios.
                                </div>

                                <div id="bloqueio-sala-conteudo" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="bloqueio_tipo">Tipo</label>
                                                <select class="form-control" id="bloqueio_tipo">
                                                    <option value="dia_inteiro">Dia inteiro</option>
                                                    <option value="intervalo">Intervalo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="bloqueio_data_inicio">Data inicial</label>
                                                <input type="date" class="form-control" id="bloqueio_data_inicio">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="bloqueio_data_fim">Data final</label>
                                                <input type="date" class="form-control" id="bloqueio_data_fim">
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="button" class="btn btn-outline-primary btn-block mb-1" id="btn-salvar-bloqueio">Salvar bloqueio</button>
                                        </div>
                                    </div>

                                    <div class="row" id="bloqueio-horarios-row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="bloqueio_hora_inicio">Hora inicial</label>
                                                <input type="time" class="form-control" id="bloqueio_hora_inicio">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="bloqueio_hora_fim">Hora final</label>
                                                <input type="time" class="form-control" id="bloqueio_hora_fim">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="bloqueio_motivo">Motivo</label>
                                                <input type="text" class="form-control" id="bloqueio_motivo" placeholder="Ex.: manutenção, limpeza, uso interno">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h5 class="mb-0">Bloqueios cadastrados</h5>
                                        <small class="text-muted">A agenda já respeita esses bloqueios.</small>
                                    </div>

                                    <div id="lista-bloqueios-sala">
                                        <div class="bloqueio-empty">Nenhum bloqueio cadastrado para esta sala.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-excluir-sala">Excluir Sala</button>
                    <button type="submit" class="btn btn-primary mr-1" id="btn-salvar-sala"><i data-feather='check-circle'></i> Salvar</button>
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal"><i data-feather='x'></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    h4 { margin-left: 18px; }
    .card-header { margin-left: 2px; }
</style>

<div class="ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-detached">
            <div class="content-body">
                <section id="ecommerce-header">
                    <div class="salas-toolbar">
                        <div class="salas-toolbar-copy">
                            <h3 class="mb-0">Gerenciamento de Salas</h3>
                            <p class="search-results">0 resultados encontrados</p>
                        </div>
                        <div class="salas-actions">
                            <a href="#" id="btn-criar-sala" class="btn btn-primary" data-toggle="modal" data-target="#modals-slide-in">
                                <i data-feather="plus-circle" class="mr-50"></i>
                                <span>Nova sala</span>
                            </a>
                        </div>
                    </div>
                </section>

                <div class="body-content-overlay"></div>

                <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                    <div class="salas-search">
                        <span class="salas-search-icon"><i data-feather="search"></i></span>
                        <input type="text" class="form-control search-product" id="shop-search" placeholder="Buscar por nome ou descrição da sala" aria-label="Buscar salas" />
                    </div>
                </section>

                <section id="ecommerce-products" class="grid-view"></section>
            </div>
        </div>
    </div>
</div>

<script>
    var enderecos = @json($enderecos);
</script>

@endsection

@push('css_vendor')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">
@endpush

@push('css_page')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-sliders.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-quill-editor.css">
@endpush

@push('js_page')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-ge-salas.js"></script>
    <script src="../../../app-assets/js/scripts/forms/form-quill-editor.js"></script>
@endpush
