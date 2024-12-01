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
                                                            <img src="{{ asset(session('reserva.imagem_principal')) }}" class="d-block w-100 rounded ml-2" alt="{{ session('reserva.sala_nome') }}">


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
                                                        <p class="card-text text-muted mt-25">Escolha a forma de pagamento desejada</p>
                                                    </div>
                                                      <hr class="my-2" />
                                                    <div class="card-body">
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input type="radio" id="payment-pix" name="paymentOptions" class="custom-control-input" checked />
                                                            <label class="custom-control-label" for="payment-pix">Pix</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="payment-card" name="paymentOptions" class="custom-control-input" />
                                                            <label class="custom-control-label" for="payment-card">Cartão de Crédito ou Débito</label>
                                                        </div>

                                                        <div class="mt-5">
                                                            
                                                            <div class="card ecommerce-card" style="grid-template-columns: 1fr 3fr !important;">
                                                                <div class="item-img">
                                                                    <a href="{{ route('site.sala.detalhes', session('reserva.sala_id')) }}">
                                                                        {{-- Imagem da sala --}}
                                                                        <img src="{{ asset(session('reserva.imagem_principal')) }}" class="d-block w-100 rounded m-2" alt="{{ session('reserva.sala_nome') }}">


                                                                    </a>
                                                                </div>
                                                                <div class="card-body ml-5">
                                                                 
                                                                        <h5 class="mb-0">
                                                                            <a href="{{ route('site.sala.detalhes', session('reserva.sala_id')) }}" class="text-body">
                                                                                {{ session('reserva.sala_nome') }}
                                                                            </a>
                                                                        </h5>                                                                                  
                                                             
                                                                    
                                                                    {{-- Dados específicos do horário --}}
                                                                    <span class="delivery-date text-muted"> <i data-feather="calendar"></i> Data da Reserva: {{ date('d/m/Y', strtotime($horario['data_reserva'])) }}</span>
                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                            
                                                            <button id="confirmar-reserva" type="button" class="btn btn-primary btn-block">Confirmar Reserva</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Fim do Pagamento do Checkout -->

                                <!-- </div> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END: Content-->



            <div class="modal fade" id="modalSucesso" tabindex="-1" role="dialog" aria-labelledby="modalSucessoLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalSucessoLabel">Reserva Confirmada!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Sua reserva foi confirmada com sucesso!
                        </div>
                        <div class="modal-footer">
                            <button id="modal-ok-button" type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
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
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endpush