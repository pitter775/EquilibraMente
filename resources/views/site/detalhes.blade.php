@extends('layouts.site-interna', [
    'elementActive' => 'detalhes'
])

@section('content')

  <style>
      .bthorasdis { margin: 5px}
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
            padding: 2px; /* Reduz o espaçamento interno */
        }

        .row.g-1 {
            gap: 5px; /* Espaço mínimo entre as imagens */
        }

        .carousel-inner img {
            max-height: 450px; /* Ajusta a altura da imagem principal */
            object-fit: cover; /* Garante que a imagem se adapte sem distorção */
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
            padding: 5px; /* Adiciona espaço entre as colunas */
        }

        .sala-detalhes .titisala { color: #777; font-size: 18px; font-weight: 500; }


        @media (max-width: 768px) {
            .carousel-inner img {
                max-height: 250px; /* Reduz a altura da imagem principal em telas menores */
            }

            .img-thumbnail {
                max-height: 70px; /* Define o tamanho máximo da imagem */
                display: block; /* Garante que a imagem seja tratada como um bloco */
                margin: 0 auto; /* Centraliza horizontalmente */
                position: relative; /* Permite o uso de posicionamento absoluto se necessário */
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
                border-radius: 8px; /* Também arredonda as bordas da imagem principal, caso necessário */
            }
            h3{ font-size: 16px !important}
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
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselSalaDetalhes" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>

                        <!-- Imagens menores na lateral -->
                        <div class="col-lg-4 d-flex flex-column" style="padding:0 0 10px 10px">
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

                            <div class="row" style="padding: 10px; margin-top: -20px">
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="col-6 menores ">
                                        @if(isset($sala->imagens[$i]))
                                            <img src="{{ $sala->imagens[$i]->imagem_base64 }}" class="img-fluid rounded w-100 menores" 
                                                alt="Imagem da sala" style=" height: 100px;" 
                                                onclick="trocarImagemPrincipal('{{ $sala->imagens[$i]->imagem_base64 }}')">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center rounded w-100" 
                                                style="height: 100px; background-color: #f1f1f1; color: #777;">
                                                <!-- Espaço vazio -->
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
            </div>

          </div>
         
        </div>
        <div style="background: #fff" >
            <div class="container">
              <div class="row">
                <!-- Nome e Descrição da Sala -->
                <div class="col-lg-8 mb-5 mt-3">                  
                    <div>
                        <!-- Conteúdo completo inicialmente escondido -->
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
                              <p>Sem conveniências cadastradas para esta sala.</p>
                          @endforelse
                      
                    </div>



                </div>

                <div class="col-lg-4">

                  <div class="row">
        
                    <div class="card p-4" style="margin-top: -40px">
                      <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                          <!-- Valor alinhado à esquerda -->
                          <p class="mt-2 mb-4 mb-0" style="font-size:25px; color: #000">
                              R$ {{ number_format($sala->valor, 2, ',', '.') }}/h
                          </p>

                          <!-- Metragem alinhada à direita -->
                          <div class="d-flex align-items-center">
                              <i class="fa-solid fa-ruler-combined me-2 pr-2" style="font-size: 15px; color: #76aa66"></i>
                              <span style="font-size: 15px; color: #333;">45 m²</span>
                          </div>
                        </div>
                        <div class="col-12">

                        

                        <a href="{{ auth()->check() ? '#' : route('login') }}" 
                          class="btn btn-primary" 
                          data-toggle="{{ auth()->check() ? 'modal' : '' }}" 
                          data-target="{{ auth()->check() ? '#modalHorarios' : '' }}">
                          Horários disponíveis
                        </a>


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


                                {{-- <h4 id="selected-date" class="mb-3 mt-3" style=" font-size: 16px">Selecione uma data no calendário.</h4>
                                @if(auth()->check())
                                  <div id="calendar"></div>
                                @else
                                  <p>Para ver a disponibilidade e fazer reservas, faça login.</p>
                                  <a href="/login" class="btn btn-primary">Entrar</a>                                  
                                @endif --}}
                              </div>
                            </div>
                    
                    </div>

                    <div class="card p-4" style="margin-top: -20px">
                        <p class="text-success mb-2">
                            <i class="fas fa-lock"></i> Este é um ambiente seguro!
                        </p>
                        <p>
                            Trabalhamos constantemente para proteger sua segurança e privacidade. 
                            <a href="{{ route('privacidade') }}" class="text-primary">Saiba mais</a>
                        </p>
                    
                    </div>

                  </div>
                </div>
              </div>
            </div>
        </div>
      </section>

      <!-- Modal para seleção de horários -->
      <div class="modal fade" id="modalHorarios" tabindex="-1" role="dialog" aria-labelledby="modalHorariosLabel" aria-hidden="true">

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
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- <h3 class="mb-4 mt-3"><span id="modalSalaNome">{{ $sala->nome }}</span></h3> --}}
              <p style='font-size: 16px'>Escolha uma data</p>

              <p>
                  <span class="mr-0">
                      <div class="input-group" style="width: 140px;">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-calendar-alt"></i> <!-- Ícone de calendário -->
                              </span>
                          </div>
                          <input type="text" id="datepicker" class="form-control" placeholder="Data">
                      </div>
                  </span>

                  <span style="float: right; margin-top: -30px">
                      <span style="font-size: 18px; color: #000;">
                          R$ <span id="valorHora">{{ number_format($sala->valor, 2, ',', '.') }}</span>
                      </span>/h
                  </span>
              </p>

            

        
             

              <div style="min-height: 170px;">
                  <hr>
                   <p id="divhorarios" style="display: none"><i class="fas fa-clock"></i> <span style='font-size: 16px'> Horários disponíveis para -> <span id='datasele'></span></span></p>
                   <div id="horarios-disponiveis">
                
                    <div class="text-center mt-4">
                        Aguardando selecionar a data para exibir os horários...
                    </div>
                    <!-- Horários serão carregados aqui via AJAX -->
                  </div>
              </div>
              
         
            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center mt-4">
                <p class="mb-0"><strong>Total:</strong> R$ <span id="valorTotal">0,00</span></p>
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
      @if(auth()->check())
        let horariosSelecionados = []; // Array para armazenar os horários selecionados
        const valorPorHora = {{ $sala->valor }}; // Valor por hora da sala

        function mostrarModalHorarios(data_reserva) {
            horariosSelecionados = []; // Reseta a seleção de horários quando abre a modal

            // Converte "20/03/2025" para "2025-03-20"
            const partesData = data_reserva.split("/");
            const dataFormatada = `${partesData[2]}-${partesData[1]}-${partesData[0]}`;

            //document.getElementById('modalDataReserva').innerText = data_reserva; // Mostra a data formatada no modal

            fetch(`/horarios-disponiveis/{{ $sala->id }}/${dataFormatada}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Erro na API: ${response.status} - ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    let horariosDisponiveisContainer = document.getElementById('horarios-disponiveis');
                    horariosDisponiveisContainer.innerHTML = '';

                    document.getElementById('divhorarios').style.display = "block";
                    document.getElementById('datasele').innerText = data_reserva;

                    data.horarios.forEach(horario => {
                        horariosDisponiveisContainer.innerHTML += `
                            <button class="btn btn-secondary horario-btn bthorasdis" 
                                onclick="selecionarHorario('${data_reserva}', '${horario.inicio}', '${horario.fim}', this)">
                                ${horario.inicio} - ${horario.fim}
                            </button>
                        `;
                    });

                    atualizarValorTotal();
                })
                .catch(error => console.error('Erro:', error));
        }


        function selecionarHorario(data_reserva, hora_inicio, hora_fim, button) {
          const horario = { data_reserva, hora_inicio, hora_fim };
          
          // Verifica se o horário já está selecionado
          const index = horariosSelecionados.findIndex(h => h.hora_inicio === hora_inicio && h.hora_fim === hora_fim);
          
          if (index === -1) {
            // Se não estiver, adiciona à lista e marca o botão
            horariosSelecionados.push(horario);
            button.classList.add('btn-success');
            button.classList.remove('btn-secondary');
          } else {
            // Se já estiver, remove da lista e desmarca o botão
            horariosSelecionados.splice(index, 1);
            button.classList.add('btn-secondary');
            button.classList.remove('btn-success');
          }

          atualizarValorTotal(); // Atualiza o valor total sempre que um horário é selecionado ou desmarcado
        }

        function atualizarValorTotal() {
          const total = horariosSelecionados.length * valorPorHora;
          document.getElementById('valorTotal').innerText = total.toFixed(2).replace('.', ',');
        }

        function confirmarReserva() {
            if (horariosSelecionados.length === 0) {
                toastr.warning('Por favor, selecione pelo menos um horário.');
                return;
            }

            // Converter datas para YYYY-MM-DD antes de enviar
            let horariosFormatados = horariosSelecionados.map(horario => {
                let partesData = horario.data_reserva.split("/"); // Divide "20/03/2025" em ["20", "03", "2025"]
                let dataFormatada = `${partesData[2]}-${partesData[1]}-${partesData[0]}`; // Converte para "2025-03-20"

                return {
                    data_reserva: dataFormatada,
                    hora_inicio: horario.hora_inicio,
                    hora_fim: horario.hora_fim
                };
            });

            console.log('Horários Formatados para envio:', JSON.stringify(horariosFormatados, null, 2)); // Veja se as datas estão corretas

            $.ajax({
                url: '/reserva/revisao',
                type: 'POST',
                data: {
                    sala_id: {{ $sala->id }},
                    horarios: horariosFormatados, // Agora está no formato correto!
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
            flatpickr("#datepicker", {
                enableTime: false, // Apenas data
                dateFormat: "d/m/Y", // Formato brasileiro
                minDate: "today", // Bloqueia datas passadas
                locale: "pt", // Deixa os nomes dos meses e dias em português
                onChange: function(selectedDates, dateStr, instance) {
                    mostrarModalHorarios(dateStr); // Chama a função passando a data selecionada
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