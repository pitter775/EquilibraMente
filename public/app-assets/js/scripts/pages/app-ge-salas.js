/*=========================================================================================
    File Name: app-ecommerce.js
    Description: salas pages js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';

$(function () {
  // Suporte para RTL (direita para esquerda)
  var direction = 'ltr';
  if ($('html').data('textdirection') == 'rtl') {
    direction = 'rtl';
  }

  // Variáveis para controlar elementos
  var sidebarShop = $('.sidebar-shop'),
      btnCart = $('.btn-cart'),
      overlay = $('.body-content-overlay'),
      sidebarToggler = $('.shop-sidebar-toggler'),
      gridViewBtn = $('.grid-view-btn'),
      listViewBtn = $('.list-view-btn'),
      priceSlider = document.getElementById('price-slider'),
      ecommerceProducts = $('#ecommerce-products'),
      sortingDropdown = $('.dropdown-sort .dropdown-item'),
      sortingText = $('.dropdown-toggle .active-sorting'),
      wishlist = $('.btn-wishlist'),
      checkout = 'app-ecommerce-checkout.html';

  // Verifica se o framework é Laravel e define a URL base
  if ($('body').attr('data-framework') === 'laravel') {
    var url = $('body').attr('data-asset-path');
    checkout = url + 'app/ecommerce/checkout';
  }

  // Mudança no dropdown de ordenação
  if (sortingDropdown.length) {
    sortingDropdown.on('click', function () {
      var $this = $(this);
      var selectedLang = $this.text();
      sortingText.text(selectedLang);
    });
  }

  // Mostrar/ocultar sidebar
  if (sidebarToggler.length) {
    sidebarToggler.on('click', function () {
      sidebarShop.toggleClass('show');
      overlay.toggleClass('show');
      $('body').addClass('modal-open');
    });
  }

  // Fechar sidebar ao clicar no overlay
  if (overlay.length) {
    overlay.on('click', function (e) {
      sidebarShop.removeClass('show');
      overlay.removeClass('show');
      $('body').removeClass('modal-open');
    });
  }

  // Inicia o controle de preços com slider
  if (typeof priceSlider !== undefined && priceSlider !== null) {
    noUiSlider.create(priceSlider, {
      start: [1500, 3500],
      direction: direction,
      connect: true,
      tooltips: [true, true],
      format: wNumb({
        decimals: 0
      }),
      range: {
        min: 51,
        max: 5000
      }
    });
  }

  // Alternar entre visualização de grid e lista
  if (gridViewBtn.length) {
    gridViewBtn.on('click', function () {
      ecommerceProducts.removeClass('list-view').addClass('grid-view');
      listViewBtn.removeClass('active');
      gridViewBtn.addClass('active');
    });
  }

  if (listViewBtn.length) {
    listViewBtn.on('click', function () {
      ecommerceProducts.removeClass('grid-view').addClass('list-view');
      gridViewBtn.removeClass('active');
      listViewBtn.addClass('active');
    });
  }

  // Função para adicionar ou remover da Wishlist
  if (wishlist.length) {
    wishlist.on('click', function () {
      var $this = $(this);
      $this.find('svg').toggleClass('text-danger');
      if ($this.find('svg').hasClass('text-danger')) {
        toastr['success']('', 'Adicionado à lista de desejos ❤️', {
          closeButton: true,
          tapToDismiss: false,
          rtl: direction
        });
      }
    });
  }
});

// Responsivo: Esconder sidebar ao redimensionar a janela
$(window).on('resize', function () {
  if ($(window).outerWidth() >= 991) {
    $('.sidebar-shop').removeClass('show');
    $('.body-content-overlay').removeClass('show');
  }
});

$(document).ready(function () {
    // Inicializa o editor Quill uma vez, fora do evento do modal
    var quill = new Quill('#descricao_quill', { theme: 'snow' });
    $('#descricao_quill').data('quill-initialized', true);

    // Ao abrir o modal, atualiza o conteúdo do Quill com o valor do textarea
    $('#modals-slide-in').on('shown.bs.modal', function () {
        var descricao = $('#descricao').val(); // Pega o valor do textarea
        quill.root.innerHTML = descricao; // Define o conteúdo do editor Quill
    });
    // Resetar o formulário ao fechar o modal
    $('#modals-slide-in').on('hidden.bs.modal', function () {
        $('#myModalLabel17').text('Adicionar Nova Sala');
        $('#add-new-sala-form')[0].reset();
        $('#add-new-sala-form').attr('action', $('#add-new-sala-form').data('action-store'));
        $('#add-new-sala-form').find('input[name="sala_id"]').remove();
        $('#imagens-existentes').empty();
        quill.root.innerHTML = '';
    });


    // Antes de enviar o formulário, copia o conteúdo do Quill para o textarea
    $('#add-new-sala-form').on('submit', function (e) {
        e.preventDefault();
        $('#descricao').val(quill.root.innerHTML);
        var actionUrl = $(this).attr('action');
        var formData = new FormData(this);
        var isEdit = $('#sala_id').length > 0;

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success && response.data) {
                    adicionarSala(response.data, isEdit);
                    $('#modals-slide-in').modal('hide');
                    toastr.success(response.message, 'Sucesso', { closeButton: true, tapToDismiss: false });
                }
            },
            error: function () {
                toastr.error('Erro ao salvar a sala.', 'Erro', { closeButton: true, tapToDismiss: false });
            }
        });
    });

            
    // Carregar salas ao iniciar
    carregarSalas();

    // Filtro de status pelo dropdown
    $('.dropdown-item').on('click', function () {
            var selectedStatus = $(this).text().toLowerCase();
            if (selectedStatus === 'todos') {
            selectedStatus = ''; // "Todos" mostra todas as salas
            }
            carregarSalas(selectedStatus);
    });

    // Busca por título ou descrição
    $('#shop-search').on('input', function () {
            var busca = $(this).val();
            carregarSalas('', busca); // Faz a busca sem alterar o status
    });

    // Função para carregar as imagens ao abrir o modal de edição
    // Abrir o modal para editar a sala
    $(document).on('click', '.btn-edit-sala', function (e) {
        e.preventDefault();
        var salaId = $(this).data('id');
        var salaUrl = `/admin/salas/${salaId}/dados`;
    
        $.get(salaUrl, function (data) {
            console.log('Dados recebidos:', data);
            if (data.sala) {
                // Atualiza os estados dos checkboxes de conveniências
                if (data.conveniencias && data.conveniencias.length > 0) {
                    data.conveniencias.forEach(function (conveniencia) {
                        var checkbox = $(`#conveniencia_${conveniencia.id}`);
                        if (checkbox.length > 0) {
                            var isChecked = data.conveniencias_selecionadas.includes(conveniencia.id);
                            checkbox.prop('checked', isChecked);
                        }
                    });
                }
    
                // Preenche os campos de endereço
                if (data.sala.endereco) {
                    $('#endereco_rua').val(data.sala.endereco.rua || '');
                    $('#endereco_numero').val(data.sala.endereco.numero || '');
                    $('#endereco_complemento').val(data.sala.endereco.complemento || '');
                    $('#endereco_bairro').val(data.sala.endereco.bairro || '');
                    $('#endereco_cidade').val(data.sala.endereco.cidade || '');
                    $('#endereco_estado').val(data.sala.endereco.estado || '');
                    $('#endereco_cep').val(data.sala.endereco.cep || '');
                }
    
                // Preenche os outros campos
                $('#nome').val(data.sala.nome);
                $('#descricao').val(data.sala.descricao);
                $('#valor').val(data.sala.valor);
                $('#status').val(data.sala.status);
    
                // Exibe as imagens existentes no modal
                var imagensContainer = $('#imagens-existentes');
                imagensContainer.empty(); // Limpa o container antes de adicionar novas imagens
    
                if (data.sala.imagens && data.sala.imagens.length > 0) {
                    data.sala.imagens.forEach(function (imagem) {
                        var imagemHtml = `
                            <div class="col-md-3 mb-2" id="imagem-${imagem.id}">
                                <img src="${imagem.imagem_base64}" class="img-fluid img-thumbnail ${imagem.principal ? 'principal' : ''}" alt="Imagem da sala">
                                <div class="mt-2">
                                    <button type="button" class="btn btn-danger btn-sm btn-remover-imagem" data-id="${imagem.id}">Excluir</button>
                                    <button type="button" class="btn btn-${imagem.principal ? 'primary' : 'info'} btn-sm definir-principal" data-id="${imagem.id}">
                                        ${imagem.principal ? 'Imagem Principal' : 'Definir Principal'}
                                    </button>
                                </div>
                            </div>
                        `;
                        imagensContainer.append(imagemHtml);
                    });
                } else {
                    imagensContainer.html('<p>Não há imagens para esta sala.</p>');
                }
    
                // Configuração do modal
                $('#add-new-sala-form').attr('action', `/admin/salas/${salaId}`);
                $('#add-new-sala-form').append('<input type="hidden" name="sala_id" id="sala_id" value="' + salaId + '">');
                $('#modals-slide-in').modal('show');
            }
        });
    });
       


    $(document).on('click', '#btn-criar-sala', function() {
        // Limpa o formulário e remove o campo `sala_id` para garantir que uma nova sala seja criada
        $('#add-new-sala-form')[0].reset(); 
        $('#sala_id').remove();
    
        // Limpa o editor de descrição
        quill.root.innerHTML = '';
    
        // Limpa as imagens existentes na modal
        $('#imagens-existentes').empty();
    
        // Define a ação do formulário para a criação
        $('#add-new-sala-form').attr('action', '/admin/salas');
    
        // Abre a modal para criação da nova sala
        $('#modals-slide-in').modal('show');
    });   
    
        
    // Excluir imagem ao clicar no botão de exclusão
    // Delegação de eventos para excluir imagem
    $(document).on('click', '.btn-remover-imagem', function () {
            var imagemId = $(this).data('id'); // Pegar o ID da imagem
            var imagemUrl = `/admin/imagens/${imagemId}`; // Rota para exclusão da imagem
    
            if (confirm('Você tem certeza que deseja excluir esta imagem?')) {
            $.ajax({
                    url: imagemUrl,
                    method: 'DELETE',
                    data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF
                    },
                    success: function (response) {
                    if (response.success) {
                            // Remover o elemento da imagem da interface
                            $(`#imagem-${imagemId}`).remove();
                            toastr.success(response.message, 'Sucesso', {
                            closeButton: true,
                            tapToDismiss: false
                            });
                    } else {
                            toastr.error('Erro ao excluir a imagem.', 'Erro', {
                            closeButton: true,
                            tapToDismiss: false
                            });
                    }
                    },
                    error: function () {
                    toastr.error('Erro ao excluir a imagem.', 'Erro', {
                            closeButton: true,
                            tapToDismiss: false
                    });
                    }
            });
            }
    });
    

    $(document).on('click', '.definir-principal', function (e) {
            e.preventDefault(); // Previne o comportamento padrão, incluindo o fechamento do modal
        
            var imagemId = $(this).data('id'); // Pega o ID da imagem
        
            $.ajax({
                url: '/imagens/' + imagemId + '/principal', // Rota para definir a imagem como principal
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    toastr.success(response.message);
        
                    // Atualize o visual para mostrar qual imagem é a principal
                    $('.img-thumbnail').removeClass('principal');
                    $('#imagem-' + imagemId + ' img').addClass('principal');
        
                    // Alterar o estado dos botões para refletir qual é a imagem principal
                    $('.definir-principal').removeClass('btn-primary').addClass('btn-info').text('Definir Principal');
                    $('#imagem-' + imagemId + ' .definir-principal').removeClass('btn-info').addClass('btn-primary').text('Imagem Principal');
                },
                error: function() {
                    toastr.error('Erro ao definir imagem principal.');
                }
            });
    });

    $(document).on('click', '#btn-excluir-sala', function (e) {
        e.preventDefault(); // Prevenir comportamento padrão

        var salaId = $('#sala_id').val(); // Pegar o ID da sala

        if (confirm('Você tem certeza que deseja excluir esta sala?')) {
                $.ajax({
                url: `/admin/salas/${salaId}`, // Rota para deletar a sala
                method: 'DELETE',
                data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // Token CSRF
                },
                success: function (response) {
                        // Mostrar mensagem de sucesso
                        toastr.success('Sala excluída com sucesso!', 'Sucesso', {
                        closeButton: true,
                        tapToDismiss: false
                        });

                        // Fechar o modal
                        $('#modals-slide-in').modal('hide');

                        // Remover o card da sala da lista
                        $(`#sala-card-${salaId}`).remove();
                },
                error: function () {
                        toastr.error('Erro ao excluir a sala.', 'Erro', {
                        closeButton: true,
                        tapToDismiss: false
                        });
                }
                });
        }
    });
});

// Função para adicionar ou atualizar uma sala dinamicamente
function adicionarSala(sala, isEdit = false) {
    // Definir imagem principal padrão como placeholder
    var imagemPrincipal = '../../../app-assets/images/pages/eCommerce/1.png'; // Placeholder padrão

    // Verifica se há imagens associadas e se alguma é marcada como principal
    if (sala.imagens && sala.imagens.length > 0) {
        let imagemPrincipalObj = sala.imagens.find(img => img.principal);
        if (imagemPrincipalObj) {
            imagemPrincipal = imagemPrincipalObj.imagem_base64; // Usa base64
        } else {
            imagemPrincipal = sala.imagens[0].imagem_base64; // Usa a primeira imagem como fallback
        }
    }

    // Limita a descrição a 100 caracteres, com reticências se for mais longa
    var descricaoCurta = sala.descricao.length > 100 ? sala.descricao.substring(0, 100) + '...' : sala.descricao;

    var salaHTML = `
        <div class="card ecommerce-card mt-0 pt-0" id="sala-card-${sala.id}">
            <div class="item-img text-center mt-0 pt-">
                <a href="#">
                    <img class="img-fluid card-img-top" src="${imagemPrincipal}" alt="Imagem da sala" />
                </a>
            </div>
            <div class="card-body">
                <div class="item-wrapper">
                    <div class="item-rating">
                        Valor por hora
                    </div>
                    <div>
                        <h6 class="item-price">R$ ${sala.valor}</h6>
                    </div>
                </div>
                <h6 class="item-name">
                    <a class="text-body" href="#"> ${sala.nome} </a>
                </h6>
                <p class="card-text item-description">
                    ${descricaoCurta}
                </p>
            </div>

            <div class="item-options text-center">
                <div class="item-wrapper">
                    <div class="item-cost">
                        <h4 class="item-price">R$ ${sala.valor}</h4>
                    </div>
                </div>

                ${sala.status === 'reservado' ? `
                <a href="javascript:void(0)" class="btn btn-light">
                    <i data-feather="heart"></i>
                    <span>Reservado</span>
                </a>` : ''}

                <a href="javascript:void(0);" class="btn btn-primary btn-cart btn-edit-sala" data-id="${sala.id}">
                    <i data-feather="edit"></i>
                    <span class="add-to-cart">Editar</span>
                </a>
            </div>
        </div>
    `;

    if (isEdit) {
        $(`#sala-card-${sala.id}`).replaceWith(salaHTML);
    } else {
        $('#ecommerce-products').prepend(salaHTML);
    }

    feather.replace(); // Recarregar os ícones Feather
}

    
// Função para carregar as salas com filtros (status ou busca)
function carregarSalas(status = '', busca = '') {
    $.ajax({
        url: '/salas/all', // Rota para buscar todas as salas
        method: 'GET',
        data: { status: status, busca: busca }, // Filtros de status e busca
        success: function (response) {
            $('#ecommerce-products').empty(); // Limpar a lista de salas

            // Atualizar a quantidade de salas no frontend
            $('.search-results').text(`${response.quantidade} resultados encontrados`);

            // Adicionar cada sala retornada
            $.each(response.salas, function (index, sala) {
                adicionarSala(sala); // Adicionar sala dinamicamente
            });
        },
        error: function () {
            toastr.error('Erro ao carregar as salas.');
        }
    });
}

// Função para carregar imagens da sala no modal de edição
function carregarImagensSala(salaId) {
    $.ajax({
        url: `/salas/${salaId}/imagens`, // Rota para buscar imagens da sala
        method: 'GET',
        success: function (response) {
            $('#imagens-existentes').empty(); // Limpa o container de imagens

            if (response.imagens && response.imagens.length > 0) {
                response.imagens.forEach(function (imagem) {
                    // Adiciona cada imagem ao container
                    $('#imagens-existentes').append(`
                        <div class="col-md-3 mb-3" id="imagem-${imagem.id}">
                            <img src="${imagem.imagem_base64}" class="img-fluid img-thumbnail ${imagem.principal ? 'principal' : ''}" alt="Imagem da sala">
                            <div class="mt-2">
                                <button type="button" class="btn btn-danger btn-sm btn-remover-imagem" data-id="${imagem.id}">Excluiiiiiiiir</button>
                                <button type="button" class="btn btn-${imagem.principal ? 'primary' : 'info'} btn-sm definir-principal" data-id="${imagem.id}">
                                    ${imagem.principal ? 'Imagem Principal' : 'Definir Principal'}
                                </button>
                            </div>
                        </div>
                    `);
                });
            } else {
                $('#imagens-existentes').html('<p>Nenhuma imagem disponível para esta sala.</p>');
            }
        },
        error: function () {
            toastr.error('Erro ao carregar as imagens.');
        }
    });
}


$(document).on('click', '.btn-delete-imagem', function() {
        var imagemId = $(this).data('id');
        
        $.ajax({
            url: `/imagens/${imagemId}`,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success(response.message);
                $(`#imagem-${imagemId}`).remove(); // Remove a imagem do modal
            },
            error: function() {
                toastr.error('Erro ao excluir imagem.');
            }
        });
});


document.addEventListener('DOMContentLoaded', function () {
    const inputValor = document.getElementById('valor');

    inputValor.addEventListener('input', function () {
        let value = inputValor.value;

        // Substitui vírgulas por pontos
        value = value.replace(/,/g, '.');

        // Remove tudo que não for número ou ponto
        value = value.replace(/[^0-9.]/g, '');

        // Garante que só exista um ponto decimal
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }

        // Atualiza o campo com o valor limpo
        inputValor.value = value;
    });
});
