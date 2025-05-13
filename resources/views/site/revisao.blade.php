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

                                <div class="card mt-4 ">
                                    <div class="card-body p-5" style="max-height: 350px; overflow-y: auto; font-size: 0.95rem; line-height: 1.6;">
                                        <h5 class="mb-3"><strong>Regulamento de Uso das Salas – Espaço Equilibra Mente</strong></h5>

                                        <p><strong> Reservas e Pagamentos</strong><br>
                                        As reservas devem ser realizadas via agenda online ou através dos contatos de WhatsApp disponíveis na plataforma.<br>
                                        O pagamento é efetuado no momento da reserva.</p>

                                        <p><strong> Cancelamento e Reagendamento</strong><br>
                                        Cancelamentos ou alterações de data podem ser feitos com até 24 horas de antecedência ao horário agendado.</p>

                                        <p><strong> Duração do Atendimento</strong><br>
                                        Cada sessão tem duração de 50 minutos, com tolerância de 5 minutos para organização da sala.<br>
                                        Exemplo: Se a reserva for às 17h, o uso vai até 17h50, com tolerância até 17h55.<br>
                                        Após esse tempo, será cobrada a próxima hora.</p>

                                        <p><strong> Recepção dos Pacientes</strong><br>
                                        Os pacientes devem ser recepcionados pelo profissional responsável, diretamente no andar onde ocorrerá o atendimento.</p>

                                        <p><strong> Atendimento Online</strong><br>
                                        O uso das salas para atendimentos online também é cobrado normalmente.</p>

                                        <p><strong> Uso Responsável do Espaço</strong><br>
                                        Ao final do atendimento, a sala deve ser entregue em ordem: sem lixos, copos ou materiais esquecidos.<br>
                                        Não é permitido consumir alimentos dentro das salas.<br>
                                        Pertences guardados nos armários devem ser retirados logo após o término do horário reservado.</p>

                                        <p><strong> Segurança e Acesso</strong><br>
                                        A senha de acesso da porta é pessoal e intransferível do terapeuta. Não deve ser compartilhada com pacientes.</p>

                                        <p><strong> Serviços Extras</strong><br>
                                        Café: Cada cápsula da cafeteira Dolce Gusto custa R$ 4,00.<br>
                                        O profissional pode trazer suas próprias cápsulas, devidamente etiquetadas com nome, e armazená-las no armário da recepção.<br>
                                        Impressões: R$ 1,00 por página impressa.</p>

                                        <p><strong> Atualização de Preços</strong><br>
                                        Os valores são reajustados todo mês de janeiro, anualmente.</p>

                                        <p><strong> Redes Sociais e Promoções</strong><br>
                                        Siga a gente no Instagram, TikTok, Facebook e Google Business: <strong>@espaco_equilibramente</strong><br>
                                        Faça um story marcando o Espaço e ganhe 10% de desconto na próxima hora reservada 🎉</p>
                                    </div>

                                    <div class="card-footer bg-white border-top-0">
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="aceitoRegras">
                                        <label class="form-check-label" for="aceitoRegras">
                                            Li e aceito os termos do regulamento de uso das salas.
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
                    <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Carregando...</span>
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
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
            document.querySelectorAll('input[name="paymentOptions"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('metodo_pagamento_input').value = this.value;
                });
            });
        });

       
    </script>
@endpush