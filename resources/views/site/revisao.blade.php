@extends('layouts.site-interna')

@section('content')

    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-number-input.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-ecommerce.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
            <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-wizard.css">
        
<style>
html .content {

    margin-left: 0 !important;
}
</style>


<div class="container mt-5">

    <div class="row">
        <div class="col-12 mt-5">
            <h2 class="mt-5">Detalhes da sua reserva</h2>

            <p>Você está quase concluindo! Aqui estão os detalhes da sua reserva para revisão:</p>

            <hr class="mt-3 mb-3">

            <!-- BEGIN: Content-->
            <div class="ecommerce-application mt-5 mb-5">
            
                <div class="content-wrapper">
                
                    <div class="content-body">
                        <div class="bs-stepper checkout-tab-steps">
                            <!-- Wizard starts -->
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#step-cart">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-box">
                                            <i data-feather="shopping-cart" class="font-medium-3"></i>
                                        </span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Carrinho</span>
                                            <span class="bs-stepper-subtitle">Itens do Seu Carrinho</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i data-feather="chevron-right" class="font-medium-2"></i>
                                </div>
                      
                                <div class="step" data-target="#step-payment">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-box">
                                            <i data-feather="credit-card" class="font-medium-3"></i>
                                        </span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Pagamento</span>
                                            <span class="bs-stepper-subtitle">Escolha a forma de pagamento</span>
                                        </span>
                                    </button>
                                </div>
                            </div>

                            
                            <!-- Wizard ends -->

                            <div class="bs-stepper-content">
                                <!-- Checkout Place order starts -->
                                <div id="step-cart" class="content">
                                    <div id="place-order" class="list-view product-checkout">
                                        <!-- Checkout Place Order Left starts -->
                                        <div class="checkout-items">

                                            {{-- Itera sobre os horários da reserva --}}
                                            @foreach(session('reserva.horarios') as $horario)
                                                <div class="card ecommerce-card">
                                                    <div class="item-img">
                                                        <a href="{{ route('site.sala.detalhes', session('reserva.sala_id')) }}">
                                                            {{-- Imagem da sala --}}
                                                            {{-- {{dd(session('reserva'))}} --}}
                                                            <img src="{{ $imagem_principal }}" class="d-block w-100 rounded ml-2" alt="{{ session('reserva.sala_nome') }}">


                                                        </a>
                                                    </div>
                                                    <div class="card-body ml-4">
                                                        <div class="item-name">
                                                            <h6 class="mb-0">
                                                                <a href="{{ route('site.sala.detalhes', session('reserva.sala_id')) }}" class="text-body">
                                                                    {{ session('reserva.sala_nome') }}
                                                                </a>
                                                            </h6>                                                                                  
                                                        </div>
                                                        
                                                        {{-- Dados específicos do horário --}}
                                                        <span class="delivery-date text-muted"> <i data-feather="calendar"></i> Data da Reserva: {{ date('d/m/Y', strtotime($horario['data_reserva'])) }}</span>
                                                        <span class="text-success">
                                                           <i data-feather="clock"></i> Horário: {{ $horario['hora_inicio'] }} - {{ $horario['hora_fim'] }}
                                                        </span>
                                                    </div>
                                                    <div class="item-options text-center">
                                                        <div class="item-wrapper">
                                                            <div class="item-cost">
                                                                <h4 class="item-price">
                                                                    R$ {{ number_format(session('reserva.valor_total') / count(session('reserva.horarios')), 2, ',', '.') }}
                                                                </h4>   
                                                                                                                    
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-light mt-1 remove-wishlist">
                                                            <i data-feather="x" class="align-middle mr-25"></i>
                                                            <span>Remover</span>
                                                        </button>                                           
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <!-- Checkout Place Order Left ends -->

                                        <!-- Checkout Place Order Right starts -->
                                       <div class="checkout-options">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="coupons input-group input-group-merge">                                                 
                                                        <h4 class="card-title detalhes-nome-sala">{{ session('reserva.sala_nome') }}</h4>
                                                    </div>
                                                    <hr />
                                                    <div class="price-details">
                                                        <h6 class="price-title">Detalhando o valor final</h6>
                                                        <ul class="list-unstyled">
                                                            <li class="price-detail">
                                                                <div class="detail-title">Valor por hora</div>
                                                                <div class="detail-amt valor-por-hora">R$ {{ number_format(session('reserva.valor_total') / count(session('reserva.horarios')), 2, ',', '.') }}</div>
                                                            </li>
                                                            <li class="price-detail">
                                                                <div class="detail-title">Quantidade de horas</div>
                                                                <div  class="detail-amt discount-amt text-success quantidade-horas">0hs</div>
                                                            </li>
                                                        </ul>
                                                        <hr />
                                                        <ul class="list-unstyled">
                                                            <li class="price-detail">
                                                                <div class="detail-title detail-total">Total</div>
                                                                <div class="valor-total" class="detail-amt font-weight-bolder">R$ 0,00</div>
                                                            </li>
                                                        </ul>
                                                        <button type="button" class="btn btn-primary btn-block btn-next place-order">Continuar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Checkout Place order Ends -->
                                </div>


                                <!-- Pagamento do Checkout -->
                                <div id="step-payment" class="content">
                                    <form id="checkout-payment" class="list-view product-checkout" onsubmit="return false;">
                                        @csrf
                                        <div class="payment-type">
                                            <div class="card">
                                                <div class="card-header flex-column align-items-start">
                                                    <h4 class="card-title">Opções de Pagamento</h4>
                                                    <p class="card-text text-muted mt-25">Ao confirmar a reserva, você será redirecionado para o <strong>PagBank</strong>, onde poderá escolher a forma de pagamento que preferir.</p>
                                                </div>
                                                <hr class="my-2" />
                                                <div class="card-body">
                                                    <!-- Opções de Pagamento -->
                                
                                                    <div class="mt-3">
                                                        <div class="card ecommerce-card" style="grid-template-columns: 1fr 3fr !important;">
                                                            <div class="item-img">
                                                                <a href="{{ route('site.sala.detalhes', session('reserva.sala_id')) }}">
                                                                    <img src="{{ $imagem_principal }}" class="d-block w-100 rounded m-2" alt="{{ session('reserva.sala_nome') }}">
                                                                </a>
                                                            </div>
                                                            <div class="card-body ml-5">
                                                                <h5 class="mb-0">
                                                                    <a href="{{ route('site.sala.detalhes', session('reserva.sala_id')) }}" class="text-body">
                                                                        {{ session('reserva.sala_nome') }}
                                                                    </a>
                                                                </h5>                                                                                  
                                                                <span class="delivery-date text-muted">
                                                                    <i data-feather="calendar"></i> Data da Reserva: {{ date('d/m/Y', strtotime($horario['data_reserva'])) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Resumo do Pedido -->
                                        <div class="amount-payable checkout-options">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Resumo do Pedido</h4>
                                                </div>
                                                <hr>
                                                <div class="card-body pt-0">
                                                    <div class="price-details pt-0">
                                                        <h6 class="price-title">{{ session('reserva.sala_nome') }}</h6>                                      

                                                        <ul class="list-unstyled price-details">
                                                            <li class="price-detail">
                                                                <div class="detail-title">Valor por hora</div>
                                                                <div class="detail-amt">R$ {{ number_format(session('reserva.valor_total') / count(session('reserva.horarios')), 2, ',', '.') }}</div>
                                                            </li>
                                                            <li class="price-detail">
                                                                <div class="detail-title">Quantidade de horas</div>
                                                                <div class="detail-amt discount-amt text-success quantidade-horas">0hs</div>
                                                            </li>  
                                                            <hr />
                                                            <li class="price-detail">
                                                                <div class="details-title" style="font-weight: 700">Total</div>
                                                                <div class="detail-amt valor-total" style="font-weight: 700">
                                                                    <strong>R$00,00</strong>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <button id="confirmar-reserva" data-reserva-id="{{ session('reserva.id') ?? '' }}" type="button" class="btn btn-primary btn-block">Confirmar Reserva</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Fim do Pagamento do Checkout -->

                                <!-- </div> -->

                                <div class="card mt-4">
                                    <div class="card-body p-5" style="max-height: 350px; overflow-y: auto; font-size: 0.95rem; line-height: 1.6;">
                                        <h5 class="mb-3"><strong><span style="color: #000 !important">Regulamento de Uso das Salas </span> Espaço Equilibra Mente</strong></h5>

                                        <p><strong>Reservas e Pagamentos</strong><br>
                                        Reservas via plataforma ou WhatsApp. Pagamento realizado no momento da reserva.
                                        </p>

                                        <p><strong>Cancelamento</strong><br>
                                        Cancelamentos com até 24h de antecedência têm reembolso integral. Após esse prazo, não há reembolso.
                                        </p>

                                        <p><strong>Duração e Tolerância</strong><br>
                                        Cada hora contratada equivale a 50 minutos de uso, com 5 minutos de tolerância. Ultrapassar o tempo gera cobrança de nova hora.
                                        </p>

                                        <p><strong>Uso do Espaço</strong><br>
                                        Apenas profissionais da saúde mental podem utilizar. Proibido uso para outros fins, fumar, consumir bebidas alcoólicas ou trazer animais.
                                        </p>

                                        <p><strong>Responsabilidade</strong><br>
                                        O profissional é responsável pelos danos causados por ele ou seus clientes. Deve manter a sala organizada após o uso.
                                        </p>

                                        <p><strong>Serviços e Itens Disponíveis</strong><br>
                                        Wi-Fi, ar-condicionado, café, água, balas, pranchetas, relógio digital e suporte de celular em todas as salas.
                                        </p>

                                        <p><strong>Regras de Segurança</strong><br>
                                        A senha da sala é pessoal e intransferível. O profissional deve recepcionar seus clientes no andar do atendimento.
                                        </p>

                                        <p><strong>Proteção de Dados</strong><br>
                                        Os dados são tratados conforme a LGPD. O cliente pode solicitar acesso, correção ou exclusão dos dados a qualquer momento.
                                        </p>

                                        <p><strong>Horário de Funcionamento</strong><br>
                                        Segunda a sexta, das 08h às 22h. Sábado, das 08h às 18h.
                                        </p>

                                        <p><strong>Redes Sociais e Promoções</strong><br>
                                        Siga @espaco_equilibramente. Marcando o espaço em um story, ganha 10% de desconto na próxima hora reservada 🎉
                                        </p>

                                        <p style="font-size: 0.85rem;"><em>Este é um resumo dos principais pontos. O regulamento completo está disponível no site ou pode ser solicitado por e-mail/WhatsApp.</em></p>
                                    </div>

                                    <div class="card-footer bg-white border-top-0">
                                        <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="aceitoRegras">
                                        <label class="form-check-label" for="aceitoRegras">
                                            Li e aceito os termos do regulamento de uso das salas.
                                            <a href="/assets/REGULAMENTO DO ESPAÇO - EQM.pdf" target="_blank" class=" btn-primary" style="margin-left: 10px; padding: 4px 8px !important">
                                            ver regulamento completo
                                            </a>
                                        </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>





                    </div>
                </div>
            </div>
            <!-- END: Content-->


            <!-- Modal de Aguardando Pagamento -->
            <div class="modal fade" id="modal-aguardando-pagamento" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aguardando Pagamento...</h5>
                </div>
                <div class="modal-body text-center">
                <p>Estamos aguardando a confirmação do seu pagamento. Isso pode levar alguns segundos.</p>

                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="spinner-border text-primary" role="status" aria-live="polite">
                    <span class="visually-hidden">Carregando...</span>
                    </div>

                    <!-- use a rota nomeada (recomendado) -->
                    <a href="{{ route('cliente.reservas') }}" class="btn btn-outline-secondary">
                    Ver minhas reservas
                    </a>

                    <!-- ou, se preferir fixo: -->
                    <!-- <a href="https://www.espacoequilibramente.com.br/cliente/reservas" class="btn btn-outline-secondary">Ver minhas reservas</a> -->
                </div>
                </div>
                </div>
            </div>
            </div>

            <!-- Modal de Sucesso -->
            <div class="modal fade" id="modal-sucesso-pagamento" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Pagamento Confirmado</h5>
                </div>
                <div class="modal-body text-center">
                    <p>Seu pagamento foi confirmado com sucesso!</p>
                </div>
                </div>
            </div>
            </div>

            <!-- Modal de Erro -->
            <div class="modal fade" id="modal-erro-pagamento" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Erro no Pagamento</h5>
                </div>
                <div class="modal-body text-center">
                    <p>Não conseguimos confirmar seu pagamento. Tente novamente.</p>
                </div>
                </div>
            </div>
            </div>


        </div>
    </div>
</div>

@endsection

@push('js_page')
   <script src="../../../app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
    <script src="../../../app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>


<script>
  $(window).on('load', function () {
    if (feather) {
      feather.replace({ width: 14, height: 14 });
    }

    document.querySelectorAll('input[name="paymentOptions"]').forEach(radio => {
      radio.addEventListener('change', function () {
        document.getElementById('metodo_pagamento_input').value = this.value;
      });
    });

    // Validação do checkbox
    document.getElementById('confirmar-reserva').addEventListener('click', function (e) {
      const aceito = document.getElementById('aceitoRegras').checked;
      if (!aceito) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Atenção!',
          text: 'Você precisa aceitar os termos do regulamento para continuar.'
        });
        return false;
      }
    });
  });
</script>
@endpush