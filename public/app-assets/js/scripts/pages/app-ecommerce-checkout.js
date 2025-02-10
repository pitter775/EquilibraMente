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

  let pagamentoVerificado = false;
  let pagbankLink = null; // Armazena o link de pagamento
  let referenceId = null; // Armazena o ID da reserva



  function iniciarVerificacaoPagamento(referenceId) {
    let tentativas = 0;
    let intervalo = setInterval(() => {
        if (pagamentoVerificado || tentativas >= 60) { // Para após 5 minutos (60 tentativas)
            clearInterval(intervalo);
            $('#modal-aguardando-pagamento').modal('hide');
            if (!pagamentoVerificado) {
                $('#modal-erro-pagamento').modal('show');
            }
            return;
        }

        $.ajax({
            url: '/pagbank/status/' + referenceId,
            method: 'GET',
            success: function (response) {
                console.log("Status do pagamento:", response);
                if (response.status === 'PAGA') {
                    pagamentoVerificado = true;
                    clearInterval(intervalo);
                    $('#modal-aguardando-pagamento').modal('hide');
                    $('#modal-sucesso-pagamento').modal('show');
                    setTimeout(() => {
                        window.location.href = '/cliente/reservas';
                    }, 3000);
                }
            },
            error: function (xhr) {
                console.error("Erro ao verificar pagamento:", xhr.responseText);
            }
        });

        tentativas++;
    }, 5000);
}


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
      if (pagbankLink) {
          console.log("Reutilizando link de pagamento:", pagbankLink);
          window.open(pagbankLink, '_blank'); // Abre o link já salvo
          $('#modal-aguardando-pagamento').modal('show');
          return false;
      }

      var metodoPagamento = $('#metodo_pagamento_input').val();

      $.ajax({
          url: '/reserva/confirmar',
          method: 'POST',
          data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
              metodo_pagamento: metodoPagamento
          },
          success: function (response) {
              console.log("Resposta do servidor (bruta):", response);

              let redirectUrl = response.redirect;

              if (typeof response.original === "object" && response.original.redirect) {
                  redirectUrl = response.original.redirect;
              }

              if (typeof redirectUrl === "string" && redirectUrl.startsWith("http")) {
                  console.log("Abrindo link correto:", redirectUrl.trim());

                  // Salva o link para reutilização
                  pagbankLink = redirectUrl.trim();

                  // Abre o link na nova aba
                  window.open(pagbankLink, '_blank');

                  // Exibe a modal de "Aguardando Pagamento"
                  $('#modal-aguardando-pagamento').modal('show');

                  // Agora, pega o reference_id que já está cadastrado na transação
                  referenceId = response.reference_id; 

                  if (referenceId) {
                      console.log("Reference ID extraído:", referenceId); // Debug

                      // Inicia a verificação do pagamento
                      iniciarVerificacaoPagamento(referenceId);
                  }
              } else {
                  console.error("Erro: Link de pagamento inválido.", redirectUrl);
                  alert('Erro inesperado. Tente novamente.');
              }
          },
          error: function (xhr) {
              console.error("Erro na requisição AJAX:", xhr.responseText);
              alert('Erro ao processar a reserva: ' + xhr.responseText);
          }
      });

      return false;
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
