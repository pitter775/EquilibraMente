@extends('layouts.site-interna', [
    'elementActive' => 'detalhes'
])

@section('content')

  <style>
        .bthorasdis { margin: 5px}
        .horarios-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .horario-slot {
            min-width: 108px;
            border-radius: 10px;
            border: 1px solid #d9e2d6;
            background: #f5f7f4;
            color: #4d5b4b;
            padding: 10px 12px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .horario-slot.horario-disponivel {
            background: #f4f7f2;
            border-color: #d9e2d6;
            color: #50624b;
        }

        .horario-slot.horario-disponivel:hover {
            background: #e9f4e6;
            border-color: #9bc18f;
        }

        .horario-slot.horario-selecionado {
            background: #2f7d3f;
            border-color: #2f7d3f;
            color: #fff;
        }

        .horario-slot.horario-reservado {
            background: #f1f3f4;
            border-color: #d6dadd;
            color: #95a0a6;
            cursor: not-allowed;
        }

        .horario-slot.horario-bloqueado {
            background: #fff1f1;
            border-color: #f1c6c6;
            color: #b24c4c;
            cursor: not-allowed;
        }

        .horarios-legenda {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 12px 0 0;
        }

        .horarios-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 120px;
            color: #66725f;
            font-weight: 500;
        }

        .horarios-loading-spinner {
            width: 18px;
            height: 18px;
            border: 2px solid #d7e3d2;
            border-top-color: #4f7e48;
            border-radius: 999px;
            animation: horarios-spin 0.8s linear infinite;
        }

        @keyframes horarios-spin {
            to {
                transform: rotate(360deg);
            }
        }

        .legenda-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #6d746b;
        }

        .legenda-ponto {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            display: inline-block;
        }

        .legenda-disponivel { background: #9bc18f; }
        .legenda-reservado { background: #cfd6da; }
        .legenda-bloqueado { background: #e9aaaa; }
 
      .fc-toolbar-title { font-size: 14px !important}
      .preco {
          font-family: Arial, sans-serif;
      }
      hr{ margin: 40px 0 40px 0}

      #descricao-curta,
        #descricao-completa {
            transition: all 0.3s ease-in-out;
        }

      .d-flex.flex-wrap .me-4 {
          margin-bottom: 10px;
      }
      .d-flex.align-items-center {
          font-size: 16px;
      }
        .img-thumbnail {
            max-height: 120px; /* Tamanho da imagem */
            object-fit: cover; /* Ajusta a imagem sem distorcer */
            border-radius: 12px; /* Define o arredondamento das bordas */
            border: none; /* Remove bordas extras */
            padding: 2px; /* Reduz o espaÃ§amento interno */
        }

        .row.g-1 {
            gap: 5px; /* EspaÃ§o mÃ­nimo entre as imagens */
        }

        .carousel-inner img {
            max-height: 450px; /* Ajusta a altura da imagem principal */
            object-fit: cover; /* Garante que a imagem se adapte sem distorÃ§Ã£o */
        }



        .col-4.d-flex.flex-column > div {
            flex: 1; /* Garante que as imagens menores tenham a mesma altura */
            text-align: center; /* Centraliza as imagens menores */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menores {
           
            transition: transform 0.3s ease, border-color 0.3s ease; /* Efeito suave ao passar o mouse */
            
        }

        .menores img:hover {
            transform: scale(1.05); /* Aumenta levemente a imagem ao passar o mouse */
            border-color: #007bff; /* Muda a cor da borda ao passar o mouse */
        }

        .col-6 {
            padding: 5px; /* Adiciona espaÃ§o entre as colunas */
        }

        .sala-detalhes .titisala { color: #777; font-size: 18px; font-weight: 500; }

        #divvalorP {display: none;}
        @media (max-width: 968px) {

            #divvalor {display: none;}
             #divvalorP {display: block !important;}

            .sala-detalhes { margin-top: 40px}

            .contentg h3 { margin-top: 40px}

            .imgspequenas { display: none !important}
            .carousel-inner img {
                max-height: 250px; /* Reduz a altura da imagem principal em telas menores */
            }

            .img-thumbnail {
                max-height: 70px; /* Define o tamanho mÃ¡ximo da imagem */
                display: block; /* Garante que a imagem seja tratada como um bloco */
                margin: 0 auto; /* Centraliza horizontalmente */
                position: relative; /* Permite o uso de posicionamento absoluto se necessÃ¡rio */
            }

            .col-4.d-flex.flex-column {
                flex-direction: row; /* Alinha as imagens menores em uma linha */
                flex-wrap: wrap; /* Permite quebra de linha */
            }

            .col-4.d-flex.flex-column > div {
                width: 48%; /* Ajusta o tamanho das imagens menores */
                margin-bottom: 5px;
            }
            .carousel-inner img {
                border-radius: 8px; /* TambÃ©m arredonda as bordas da imagem principal, caso necessÃ¡rio */
            }
            h3{ font-size: 16px !important}

            .totalreserv{ margin-bottom: 10px !important}
        }

      

         .contentg h3 {
            font-size: 20px;
            color: #333;
            font-weight: 600;
        }
        .contentg p { font-size: 15px; color: #555}
        .contentg h3 span {
            color: #216C2E;
        }

        .status-sala-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 14px;
            margin: 18px 0 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-sala-banner.indisponivel {
            background: #fff1f1;
            color: #b24c4c;
            border: 1px solid #f2caca;
        }

        .btn-reserva-indisponivel {
            background: #d8ddd7 !important;
            border-color: #d8ddd7 !important;
            color: #6d746b !important;
            cursor: not-allowed;
        }

        .btn-disponibilidade {
            font-family: inherit;
            font-weight: 600;
            letter-spacing: 0;
        }

  </style>

    <main id="main" style="margin-top: 40px">

      <section class="sala-detalhes pb-0">
        <div class="container">
          <div class="row">
      
            <div class="col-lg-12 ">
                @if($sala->imagens->isNotEmpty())
                    <div class="row">
                        <!-- Imagem principal do carrossel -->
                        <div class="col-lg-8 col-md-12">
                            <div id="carouselSalaDetalhes" class="carousel slide carousel-fade" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($sala->imagens as $index => $imagem)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ $imagem->imagem_base64 }}" class="d-block w-100 rounded" alt="{{ $sala->nome }}">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselSalaDetalhes" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselSalaDetalhes" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" ></span>
                                    <span class="sr-only">PrÃ³ximo</span>
                                </a>
                            </div>
                        </div>

                        <!-- Imagens menores na lateral -->
                        <div class="col-lg-4 d-flex flex-column imgspequenas" style="padding:0 0 10px 10px">
                            <div class="row">
                                <!-- Primeira imagem grande -->
                                <div class="col-12 menores">
                                    @if(isset($sala->imagens[0]))
                                        <img src="{{ $sala->imagens[0]->imagem_base64 }}" class="img-fluid rounded w-100 menores" 
                                            alt="Imagem da sala" style="height: 90%;" 
                                            onclick="trocarImagemPrincipal('{{ $sala->imagens[0]->imagem_base64 }}')">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center rounded w-100" 
                                            style="height: 140px; background-color: #f1f1f1; color: #777;">
                                            Sem imagem
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row imgspequenas" style="padding: 10px; margin-top: -20px">
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="col-6 menores ">
                                        @if(isset($sala->imagens[$i]))
                                            <img src="{{ $sala->imagens[$i]->imagem_base64 }}" class="img-fluid rounded w-100 menores" 
                                                alt="Imagem da sala" style=" height: 100px;" 
                                                onclick="trocarImagemPrincipal('{{ $sala->imagens[$i]->imagem_base64 }}')">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center rounded w-100" 
                                                style="height: 100px; background-color: #f1f1f1; color: #777;">
                                                <!-- EspaÃ§o vazio -->
                                            </div>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>







                    </div>
                @endif

               <div class="contentg">
                        <h3>Sobre a<span> {{ $sala->nome }}</span></h3>                    
                    </div>

                @if($sala->status === 'indisponivel')
                    <div class="status-sala-banner indisponivel">
                        <span>Esta sala estÃ¡ temporariamente indisponÃ­vel para novas reservas.</span>
                        <span>VocÃª ainda pode consultar os detalhes.</span>
                    </div>
                @endif
            </div>

          </div>
         
        </div>
        <div style="background: #fff" >
            <div class="container">
              <div class="row">

               
                <!-- Nome e DescriÃ§Ã£o da Sala -->
                <div class="col-lg-8 mb-5 mt-3">                  
                    <div>
                     <div id="divvalorP" class="card p-4">
                    <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <!-- Valor alinhado Ã  esquerda -->
                        <p class="mt-2 mb-4 mb-0" style="font-size:25px; color: #000">
                            R$ {{ number_format($sala->valor, 2, ',', '.') }}/h
                        </p>

                        <!-- Metragem alinhada Ã  direita -->
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-ruler-combined me-2 pr-2" style="font-size: 15px; color: #76aa66"></i>
                            <span style="font-size: 15px; color: #333;">{{$sala->metragem}} mÂ²</span>
                        </div>
                    </div>
                    <div class="col-12">

                    

                    @if($sala->status === 'indisponivel')
                        <button type="button" class="btn btn-primary btn-reserva-indisponivel" disabled>
                            Sala indisponível no momento
                        </button>
                    @else
                        <a href="{{ auth()->check() ? '#' : route('login') }}" 
                            class="btn btn-primary btn-disponibilidade" 
                            data-toggle="{{ auth()->check() ? 'modal' : '' }}" 
                            data-target="{{ auth()->check() ? '#modalHorarios' : '' }}">
                            Horários disponíveis
                        </a>
                    @endif


                    </div>
                    </div>
                
                </div>
                        <!-- ConteÃºdo completo inicialmente escondido -->
                        <div id="descricao-completa">
                            {!! $sala->descricao !!}
                        </div>
                    </div>


                    <hr>
                
                    <div class="d-flex flex-wrap ">
                      
                          @forelse($sala->conveniencias as $conveniencia)
                            <div class="card m-2 p-2">
                              <div class="d-flex align-items-center  ">
                                  <i class="{{ $conveniencia->icone }} me-2 pr-1 mr-1" style="font-size: 15px; color: #76aa66"></i>
                                  <span style="font-size: 13px; color: #999">{{ $conveniencia->nome }}</span>
                              </div>
                            </div>
                          @empty
                              <p>Sem conveniÃªncias cadastradas para esta sala.</p>
                          @endforelse
                      
                    </div>



                </div>

                <div class="col-lg-4">

                  <div class="row">
        
                    <div id="divvalor" class="card p-4" style="margin-top: -40px">
                      <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                          <!-- Valor alinhado Ã  esquerda -->
                          <p class="mt-2 mb-4 mb-0" style="font-size:25px; color: #000">
                              R$ {{ number_format($sala->valor, 2, ',', '.') }}/h
                          </p>

                          <!-- Metragem alinhada Ã  direita -->
                          <div class="d-flex align-items-center">
                              <i class="fa-solid fa-ruler-combined me-2 pr-2" style="font-size: 15px; color: #76aa66"></i>
                              <span style="font-size: 15px; color: #333;">{{$sala->metragem}} mÂ²</span>
                          </div>
                        </div>
                        <div class="col-12">

                        

                        @if($sala->status === 'indisponivel')
                          <button type="button" class="btn btn-primary btn-reserva-indisponivel" disabled>
                              Sala indisponível no momento
                          </button>
                        @else
                          <a href="{{ auth()->check() ? '#' : route('login') }}" 
                            class="btn btn-primary btn-disponibilidade" 
                            data-toggle="{{ auth()->check() ? 'modal' : '' }}" 
                            data-target="{{ auth()->check() ? '#modalHorarios' : '' }}">
                            Horários disponíveis
                          </a>
                        @endif


                        </div>
                      </div>
                    
                    </div>

                    <div class="card p-4" style="margin-top: -20px">
                        
                            <p> <i class="fa-solid fa-map-marker-alt me-2 pr-1 mr-1" style="font-size: 15px; color: #76aa66"></i>
                                {{ $sala->endereco->rua }}, {{ $sala->endereco->numero }}, {{ $sala->endereco->bairro }} - {{ $sala->endereco->cidade }}, {{ $sala->endereco->estado }}</p>

                              <iframe
                                  width="100%"
                                  height="300"
                                  style="border:0"
                                  loading="lazy"
                                  allowfullscreen
                                  src="https://www.google.com/maps?q={{ urlencode($sala->endereco->rua . ', ' . $sala->endereco->numero . ', ' . $sala->endereco->bairro . ', ' . $sala->endereco->cidade . ', ' . $sala->endereco->estado) }}&output=embed">
                              </iframe>

                            <div class="row mt-3">
                              <div class="col-lg-12 ">


                                {{-- <h4 id="selected-date" class="mb-3 mt-3" style=" font-size: 16px">Selecione uma data no calendÃ¡rio.</h4>
                                @if(auth()->check())
                                  <div id="calendar"></div>
                                @else
                                  <p>Para ver a disponibilidade e fazer reservas, faÃ§a login.</p>
                                  <a href="/login" class="btn btn-primary">Entrar</a>                                  
                                @endif --}}
                              </div>
                            </div>
                    
                    </div>

                    <div class="card p-4" style="margin-top: -20px">
                        <p class="text-success mb-2">
                            <i class="fas fa-lock"></i> Este Ã© um ambiente seguro!
                        </p>
                        <p>
                            Trabalhamos constantemente para proteger sua seguranÃ§a e privacidade. 
                            <a href="{{ route('privacidade') }}" class="text-primary">Saiba mais</a>
                        </p>
                    
                    </div>

                  </div>
                </div>
              </div>
            </div>
        </div>
      </section>

      <!-- Modal para seleÃ§Ã£o de horÃ¡rios -->
      <div class="modal fade" id="modalHorarios" tabindex="-1" role="dialog" aria-labelledby="modalHorariosLabel" >

        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                   <span class="avatar">
                      @if(auth()->check())
                        @if(Auth::user()->photo == null)
                          <img src=" {{asset('app-assets/images/avatars/avatar.png')}}" alt="avatar" height="40" width="40">
                        @endif
                        @if(Auth::user()->photo !== null)
                          <img src="{{ Auth::user()->photo }}" alt="avatar" height="40" width="40">
                        @endif
                      @endif
                  </span>
              <h5 class="modal-title ml-3 mt-2" id="modalHorariosLabel">Reservando - {{ $sala->nome }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span >&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- <h3 class="mb-4 mt-3"><span id="modalSalaNome">{{ $sala->nome }}</span></h3> --}}
              <p style='font-size: 16px'>Escolha uma data</p>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-1">

                    {{-- Data --}}
                    <div class="mb-1 mb-md-0" style="width: 100%; max-width: 300px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" id="datepicker" class="form-control" placeholder="Data">
                        </div>
                    </div>

                    {{-- Valor por hora --}}
                    <div class="mt-1 mt-md-0 text-md-right w-100" style="max-width: 150px;">
                        <span style="font-size: 18px; color: #000;">
                            R$ <span id="valorHora">{{ number_format($sala->valor, 2, ',', '.') }}</span>
                        </span>/h
                    </div>

                </div>


            

        
             

              <div style="min-height: 170px;">
                  <hr>
                   <p id="divhorarios" style="display: none"><i class="fas fa-clock"></i> <span style='font-size: 13px'> Agenda do dia <i class="fas fa-calendar-alt"></i> <b><span id='datasele'></span></b></span></p>
                   <div id="horarios-disponiveis">
                
                    <div class="text-center mt-4">
                        Aguardando selecionar a data para exibir os horários...
                    </div>
                    <!-- HorÃ¡rios serÃ£o carregados aqui via AJAX -->
                  </div>
                  <div class="horarios-legenda" id="horarios-legenda" style="display:none;">
                    <span class="legenda-item"><span class="legenda-ponto legenda-disponivel"></span> DisponÃ­vel</span>
                    <span class="legenda-item"><span class="legenda-ponto legenda-reservado"></span> Reservado</span>
                    <span class="legenda-item"><span class="legenda-ponto legenda-bloqueado"></span> Bloqueado</span>
                  </div>
              </div>
              
         
            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center mt-4">
                <p class="mb-0 totalreserv"><strong>Total:</strong> R$ <span id="valorTotal">0,00</span></p>
                <div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="confirmarReserva()">Reservar</button>
                </div>
            </div>

          </div>
        </div>
      </div>
    </main>

@endsection



@push('js_page')

  <script>
      const salaIndisponivel = @json($sala->status === 'indisponivel');
      @if(auth()->check())
        let horariosSelecionados = [];
        const valorPorHora = {{ $sala->valor }};

        function formatarLabelHorario(horaInicio, horaFim) {
            return `${horaInicio.substring(0, 2)}hs - ${horaFim.substring(0, 2)}hs`;
        }

        function renderizarAgendaVazia(mensagem) {
            document.getElementById('horarios-disponiveis').innerHTML = `
                <div class="text-center mt-4">${mensagem}</div>
            `;
            document.getElementById('horarios-legenda').style.display = "none";
        }

        function renderizarAgendaCarregando() {
            document.getElementById('horarios-disponiveis').innerHTML = `
                <div class="horarios-loading">
                    <span class="horarios-loading-spinner" aria-hidden="true"></span>
                    <span>Carregando agenda do dia...</span>
                </div>
            `;
            document.getElementById('horarios-legenda').style.display = "none";
        }

        function mostrarModalHorarios(data_reserva) {
            if (salaIndisponivel) {
                renderizarAgendaVazia('Esta sala está temporariamente indisponível para novas reservas.');
                document.getElementById('divhorarios').style.display = "none";
                document.getElementById('datasele').innerText = '';
                toastr.warning('Esta sala está temporariamente indisponível para novas reservas.');
                return;
            }

            horariosSelecionados = [];

            const partesData = data_reserva.split("/");
            const dataFormatada = `${partesData[2]}-${partesData[1]}-${partesData[0]}`;
            document.getElementById('divhorarios').style.display = "block";
            document.getElementById('datasele').innerText = data_reserva;
            renderizarAgendaCarregando();

            fetch(`/horarios-disponiveis/{{ $sala->id }}/${dataFormatada}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Erro na API: ${response.status} - ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const horariosDisponiveisContainer = document.getElementById('horarios-disponiveis');
                    const legenda = document.getElementById('horarios-legenda');

                    if (!data.horarios || data.horarios.length === 0) {
                        renderizarAgendaVazia('Nenhum horário foi encontrado para esta data.');
                        atualizarValorTotal();
                        return;
                    }

                    horariosDisponiveisContainer.innerHTML = `
                        <div class="horarios-grid">
                            ${data.horarios.map(horario => {
                                const classeStatus = `horario-${horario.status}`;
                                const label = formatarLabelHorario(horario.inicio, horario.fim);
                                const mensagem = horario.mensagem || '';

                                if (horario.status !== 'disponivel') {
                                    return `
                                        <button
                                            type="button"
                                            class="horario-slot ${classeStatus}"
                                            disabled
                                            title="${mensagem}">
                                            ${label}
                                        </button>
                                    `;
                                }

                                return `
                                    <button
                                        type="button"
                                        class="horario-slot ${classeStatus}"
                                        title="${mensagem}"
                                        onclick="selecionarHorario('${data_reserva}', '${horario.inicio}', '${horario.fim}', this)">
                                        ${label}
                                    </button>
                                `;
                            }).join('')}
                        </div>
                    `;

                    legenda.style.display = "flex";
                    atualizarValorTotal();
                })
                .catch(error => {
                    console.error('Erro:', error);
                    renderizarAgendaVazia('Não foi possível carregar a agenda deste dia.');
                    toastr.error('Não foi possível carregar os horários agora. Tente novamente.');
                });
        }

        function selecionarHorario(data_reserva, hora_inicio, hora_fim, button) {
          const horario = { data_reserva, hora_inicio, hora_fim };
          const index = horariosSelecionados.findIndex(h => h.hora_inicio === hora_inicio && h.hora_fim === hora_fim);
          
          if (index === -1) {
            horariosSelecionados.push(horario);
            button.classList.add('horario-selecionado');
          } else {
            horariosSelecionados.splice(index, 1);
            button.classList.remove('horario-selecionado');
          }

          atualizarValorTotal();
        }

        function atualizarValorTotal() {
          const total = horariosSelecionados.length * valorPorHora;
          document.getElementById('valorTotal').innerText = total.toFixed(2).replace('.', ',');
        }

        function confirmarReserva() {

             @if(auth()->check())
                const status = "{{ auth()->user()->status_aprovacao }}";

                if (status !== 'aprovado') {
                    toastr.warning('Seu cadastro ainda está em análise. Aguarde a aprovação para concluir uma reserva.');
                    return;
                }
            @endif

            if (horariosSelecionados.length === 0) {
                toastr.warning('Por favor, selecione pelo menos um horário.');
                return;
            }

            let horariosFormatados = horariosSelecionados.map(horario => {
                let partesData = horario.data_reserva.split("/");
                let dataFormatada = `${partesData[2]}-${partesData[1]}-${partesData[0]}`;

                return {
                    data_reserva: dataFormatada,
                    hora_inicio: horario.hora_inicio,
                    hora_fim: horario.hora_fim
                };
            });

            console.log('Horários formatados para envio:', JSON.stringify(horariosFormatados, null, 2));

            $.ajax({
                url: '/reserva/revisao',
                type: 'POST',
                data: {
                    sala_id: {{ $sala->id }},
                    horarios: horariosFormatados,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else if (response.error) {
                        toastr.error(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro no AJAX:', xhr.responseText);
                    toastr.error('Erro ao processar a reserva. Tente novamente.');
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const modalHorarios = document.getElementById('modalHorarios');

            if (modalHorarios && salaIndisponivel) {
                $('#modalHorarios').on('show.bs.modal', function(event) {
                    event.preventDefault();
                    toastr.warning('Esta sala está temporariamente indisponível para novas reservas.');
                });
            }

            flatpickr("#datepicker", {
                enableTime: false,
                dateFormat: "d/m/Y",
                minDate: "today",
                locale: "pt",
                onChange: function(selectedDates, dateStr, instance) {
                    mostrarModalHorarios(dateStr);
                }
            });
        });


      @endif
      function trocarImagemPrincipal(novaImagem) {
          const carrosselAtivo = document.querySelector('#carouselSalaDetalhes .carousel-item.active img');
          if (carrosselAtivo) {
              carrosselAtivo.src = novaImagem;
          }
      }
      window.trocarImagemPrincipal = trocarImagemPrincipal;




    
  </script>
@endpush



