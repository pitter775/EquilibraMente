@extends('layouts.app', [
    'elementActive' => 'salas'
])
@section('content')

    <!-- Modal para Adicionar Sala -->
    <div class="modal fade text-left" id="modals-slide-in">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17">Adicionar Nova Sala</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form class="add-new-sala modal-content pt-0" method="POST" id="add-new-sala-form" enctype="multipart/form-data" action="{{ route('salas.store') }}">                
                        @csrf  
                        
                        <div class="modal-body">  
                            <div class="row">
                                <div class="col-12">
                                <h3 class="mt-3">Dados iniciais</h3>
                                    <div class="form-group">
                                        <label class="form-label" for="nome">Nome</label>
                                        <input type="text" class="form-control" id="nome" placeholder="Nome da Sala" name="nome" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="disponivel">Disponível</option>
                                            <option value="indisponivel">Indisponível</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-label" for="valor">Valor</label>
                                        <input type="text" class="form-control" id="valor" placeholder="Valor Diaria" name="valor" required>
                                    </div>
                                </div>


                                <div class="col-12">
                                    
                                    <div id="novo-endereco-form">                           
                                        <h3 class="mt-3">Endereço</h3>
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
                                
                                
                                <div class="col-12">
                                    <h3 class="mt-3">Conveniências</h3>
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
                                
                                <div class="col-12">
                                    <h3 class="mt-3">Imagens</h3>
                                    <div class="form-group">
                                        <label class="form-label" for="imagens">Imagens da Sala</label>
                                        <input type="file" name="imagens[]" id="imagens" multiple class="form-control" accept="image/*">
                                    </div>

                                    <!-- Exibir imagens já carregadas quando estiver no modo de edição -->
                                    <div id="imagens-existentes" class="row mt-2">
                                        <!-- Aqui serão exibidas as imagens da sala quando estiver editando -->
                                    </div>
                                    
    
                                </div> 
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="descricao">Descrição</label>
                                        <div id="descricao_quill"></div>
                                        <textarea class="form-control" id="descricao" name="descricao" style="display: none;"></textarea>
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="btn-excluir-sala">Excluir Sala</button>                    
                            <button type="submit" class="btn btn-primary mr-1"><i data-feather='check-circle'></i> Salvar</button>
                            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal"><i data-feather='x'></i> Cancelar</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Fim-->
    <style>
        h4{ margin-left: 18px;}
        .card-header{ margin-left: 2px;}
    </style>

    <div class="ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Gerenciamento de Salas</h2>
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-detached">
                <div class="content-body">
                    <!-- E-commerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                        </button>
                                        <div class="search-results"></div>
                                    </div>
                                    <div class="view-options d-flex">
                                
                                        <a href="#" id="btn-criar-sala" class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0" data-toggle="modal" data-target="#modals-slide-in">
                                            <i data-feather="heart" class="mr-50"></i>
                                            <span class="">Criar Salas</span>
                                        </a>
                                        <div class="btn-group dropdown-sort">
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="active-sorting">Todos</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);">Todos</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Livre</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Reservado</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Alugado</a>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn">
                                                <input type="radio" name="radio_options" id="radio_option1" checked />
                                                <i data-feather="grid" class="font-medium-3"></i>
                                            </label>
                                            <label class="btn btn-icon btn-outline-primary view-btn list-view-btn">
                                                <input type="radio" name="radio_options" id="radio_option2" />
                                                <i data-feather="list" class="font-medium-3"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Content Section Starts -->

                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="body-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- E-commerce Search Bar Starts -->
                    <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control search-product" id="shop-search" placeholder="Buscar Salas" aria-label="Search..." aria-describedby="shop-search" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Search Bar Ends -->

                    <!-- Exibir salas -->
                    <section id="ecommerce-products" class="grid-view">

                    </section>
                    <!-- E-commerce Products Ends -->
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-ge-salas.js"></script>
    <script src="../../../app-assets/js/scripts/forms/form-quill-editor.js"></script>

@endpush


