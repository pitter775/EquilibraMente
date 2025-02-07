/*=========================================================================================
    File Name: app-ecommerce.js
    Description: Ecommerce pages js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  $(document).ready(function () {
    atualizarDetalhes();

    // Antes de confirmar a reserva, buscar os dados do cliente do backend
    function buscarDadosCliente(reservaId) {
      return $.ajax({
        url: '/reserva/dados/' + reservaId, // Nova rota para obter os dados do backend
        method: 'GET',
        dataType: 'json'
      });
    }

    $('#confirmar-reserva').on('click', function () {
      var metodoPagamento = $('#metodo_pagamento_input').val();
      var reservaId = $(this).data('reserva-id') || $('#confirmar-reserva').attr('data-reserva-id');

      if (!reservaId) {
        alert('Erro: ID da reserva não encontrado.');
        console.error('Erro: reservaId não definido.');
        return;
      }

      // Buscar os dados do backend antes de continuar
      buscarDadosCliente(reservaId).done(function (dados) {
        console.log("Dados do backend:", dados);

        if (!dados || !dados.cliente || !dados.valor_total) {
          alert('Erro ao buscar os dados do cliente.');
          return;
        }

        var clienteNome = dados.cliente.name;
        var clienteEmail = dados.cliente.email;
        var clienteCPF = dados.cliente.cpf;
        var clienteTelefone = dados.cliente.telefone;
        var valorTotal = dados.valor_total;

        console.log("Dados capturados:", {
          metodoPagamento,
          reservaId,
          clienteNome,
          clienteEmail,
          clienteCPF,
          clienteTelefone,
          valorTotal
        });

        // Verifica se os dados estão preenchidos
        if (!clienteNome || !clienteEmail || !clienteCPF || !clienteTelefone || isNaN(valorTotal)) {
          alert('Preencha todas as informações corretamente antes de confirmar a reserva.');
          console.error("Erro: Alguns campos estão vazios ou inválidos.");
          return;
        }

        $.ajax({
            url: '/reserva/confirmar', 
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                reserva_id: reservaId,
                cliente_nome: clienteNome,
                cliente_email: clienteEmail,
                cliente_cpf: clienteCPF,
                cliente_telefone: clienteTelefone,
                valor_total: valorTotal,
                metodo_pagamento: metodoPagamento
            },
            success: function (response) {
                console.log("Resposta do servidor:", response);
                if (response.error) {
                    alert('Erro: ' + response.error);
                } else if (response.redirect) {
                    window.open(response.redirect, '_blank'); // Abre o link de pagamento
                } else {
                    alert('Erro inesperado. Tente novamente.');
                }
            },
            error: function (xhr) {
                console.error("Erro na requisição AJAX:", xhr.responseText);
                alert('Erro ao processar a reserva: ' + xhr.responseText);
            }
        });

      }).fail(function () {
        alert('Erro ao buscar os dados do cliente.');
      });
    });
  
  
  

    // Redireciona para a tela de reservas do cliente ao fechar o modal
    $('#modal-ok-button').on('click', function () {
        window.location.href = '/cliente/reservas'; // Página de reservas do cliente
    });
});

  // Função para recalcular os detalhes do carrinho
  function atualizarDetalhes() {
      let totalHoras = -1;
      let valorTotal = 0;

      // Itera sobre os itens restantes no carrinho
      $('.ecommerce-card').each(function () {
          // Extrai e processa o valor do item
          const valorTexto = $(this).find('.item-price').text().trim().replace('R$', '').replace('.', '').replace(',', '.'); // Remove 'R$', substitui ponto por nada e vírgula por ponto
          const valorItem = parseFloat(valorTexto); // Converte para número decimal

          // Confere se o valor é válido
          if (!isNaN(valorItem)) {
              valorTotal += valorItem; // Soma o valor do item ao total
          }

          // Horários reservados (cada item = 1 hora)
          totalHoras += 1;
      });

      // Atualiza o DOM com os novos valores
      $('.quantidade-horas').text(`${totalHoras}hs`);
      $('.valor-total').text(`R$ ${valorTotal.toFixed(2).replace('.', ',')}`);
  }

  var quantityCounter = $('.quantity-counter'),
    CounterMin = 1,
    CounterMax = 10,
    bsStepper = document.querySelectorAll('.bs-stepper'),
    checkoutWizard = document.querySelector('.checkout-tab-steps'),
    removeItem = $('.remove-wishlist'),
    moveToCart = $('.move-cart'),
    isRtl = $('html').attr('data-textdirection') === 'rtl';

  // remove items from wishlist page
    removeItem.on('click', function () {
      $(this).closest('.ecommerce-card').remove();
      atualizarDetalhes();
      toastr['error']('', 'Item Removido 🗑️', {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl
      });
    });


  // move items to cart
  moveToCart.on('click', function () {
    $(this).closest('.ecommerce-card').remove();

  });

  // Checkout Wizard

  // Adds crossed class
  if (typeof bsStepper !== undefined && bsStepper !== null) {
    for (var el = 0; el < bsStepper.length; ++el) {
      bsStepper[el].addEventListener('show.bs-stepper', function (event) {
        var index = event.detail.indexStep;
        var numberOfSteps = $(event.target).find('.step').length - 1;
        var line = $(event.target).find('.step');

        // The first for loop is for increasing the steps,
        // the second is for turning them off when going back
        // and the third with the if statement because the last line
        // can't seem to turn off when I press the first item. ¯\_(ツ)_/¯

        for (var i = 0; i < index; i++) {
          line[i].classList.add('crossed');

          for (var j = index; j < numberOfSteps; j++) {
            line[j].classList.remove('crossed');
          }
        }
        if (event.detail.to == 0) {
          for (var k = index; k < numberOfSteps; k++) {
            line[k].classList.remove('crossed');
          }
          line[0].classList.remove('crossed');
        }
      });
    }
  }

  // Init Wizard
  if (typeof checkoutWizard !== undefined && checkoutWizard !== null) {
    var wizard = new Stepper(checkoutWizard, {
      linear: false
    });

    $(checkoutWizard)
      .find('.btn-next')
      .each(function () {
        $(this).on('click', function (e) {
          wizard.next();
        });
      });

    $(checkoutWizard)
      .find('.btn-prev')
      .on('click', function () {
        wizard.previous();
      });
  }

  // checkout quantity counter
  if (quantityCounter.length > 0) {
    quantityCounter
      .TouchSpin({
        min: CounterMin,
        max: CounterMax
      })
      .on('touchspin.on.startdownspin', function () {
        var $this = $(this);
        $('.bootstrap-touchspin-up').removeClass('disabled-max-min');
        if ($this.val() == 1) {
          $(this).siblings().find('.bootstrap-touchspin-down').addClass('disabled-max-min');
        }
      })
      .on('touchspin.on.startupspin', function () {
        var $this = $(this);
        $('.bootstrap-touchspin-down').removeClass('disabled-max-min');
        if ($this.val() == 10) {
          $(this).siblings().find('.bootstrap-touchspin-up').addClass('disabled-max-min');
        }
      });
  }
});
