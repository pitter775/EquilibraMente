   <!DOCTYPE html>
   <html lang="en">

   <head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta name="theme-color" content="#556050"> 

      <title>Espaço Equilibra Mente - Salas para Psicólogos e Terapeutas</title>

      <!-- Open Graph Meta Tags -->
      <meta property="og:title" content="Espaço Equilibra Mente - Salas para Psicólogos e Terapeutas" />
      <meta property="og:description" content="Salas modernas e acolhedoras para psicólogos, terapeutas e profissionais da saúde. Alugue por hora ou período, em um espaço pensado para o bem-estar." />
      <meta property="og:image" content="https://equilibramente-production.up.railway.app/assets/img/sala1.jpg" />
      <meta property="og:url" content="https://www.espacoequilibramente.com.br/" />
      <meta property="og:type" content="website" />

      <!-- Twitter Meta Tags -->
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="Espaço Equilibra Mente - Salas para Psicólogos e Terapeutas" />
      <meta name="twitter:description" content="Salas modernas e acolhedoras para psicólogos, terapeutas e profissionais da saúde. Alugue por hora ou período, em um espaço pensado para o bem-estar." />
      <meta name="twitter:image" content="https://equilibramente-production.up.railway.app/assets/img/sala1.jpg" />

      <!-- Meta Tags para SEO -->
      <meta name="description" content="Aluguel de salas confortáveis e bem localizadas, ideais para psicólogos, terapeutas e outros profissionais da saúde. Ambiente tranquilo e profissional." />
      <meta name="keywords" content="aluguel de salas para psicólogos, salas para terapeutas, consultório compartilhado, espaço terapêutico, Equilibra Mente" />
      <meta name="author" content="Espaço Equilibra Mente" />

      {{-- <script type="module" src="https://www.hiia.com.br/js/chat-widget.js?token=5db76f46-177f-467e-a587-5540ca119c28" data-api="https://www.hiia.com.br"></script> --}}

   <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Favicons -->
   <link href="/assets/img/favicon.png" rel="icon">
   <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

   <!-- Google Fonts -->
   {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet"> --}}
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

   <!-- Vendor CSS Files -->
   <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
   <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="/assets/vendor/venobox/venobox.css" rel="stylesheet">
   <link href="/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
   <link href="/assets/vendor/aos/aos.css" rel="stylesheet">

   <!-- Template Main CSS File -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">
   <link href="/assets/css/style.css" rel="stylesheet">

   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-GRG4XXWLH3"></script>
   {{-- icons https://www.streamlinehq.com/icons/streamline-colors/travel?icon=ico_YY8fEshC5TqBXh1J --}}
   <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-GRG4XXWLH3');
   </script>
      <style>


         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
         }
         #inicio {
            margin-top: -100px;
            position: relative;
            width: 100%;
            height: 80vh;
            overflow: hidden;
            background: black;
         }
         #hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(241, 241, 241, 0.7);
            z-index: 1;
         }
         .slides {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
         }
         .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1s ease-in-out;
         }
         .slide::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
         }
         .slide.active {
            opacity: 1;
         }
         .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: #eee;
         }
         .logbanner {
            filter: brightness(1) invert(1);
            margin-bottom: 10px;
            width: 300px;
         }
         .dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            z-index: 2;
         }
         .dot {
            width: 10px;
            height: 10px;
            margin: 5px;
            background: white;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s;
         }
         .dot.active {
            opacity: 1;
         }








         #comofunciona {
            position: relative;
            margin-top: -100px;
         }
         .comofunciona {

            padding: 50px;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;

            text-align: center;
            background-color: #fafafa;
         }
         .comotext {          
            margin: 0 auto;
            display: flex;
            align-items: center;
            padding: 0 30px;
         }
         .comofunciona-text {
            flex: 1;
            text-align: left;
         }
         .comofunciona-text h2 {
            font-size: 20px;
            color: #333;
         }
         .comofunciona-text h2 span {
            color: #216C2E;
         }
         .comofunciona-text p {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
         }
         .steps {
            flex: 2.5;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 30px;
            position: relative;
         }
         .step {
            width: 20%;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            position: relative;
         }
         .step i {
            font-size: 24px;
            color: #216C2E;
            display: block;
            margin-bottom: 10px;
         }
         .step video {
            width: 80px;
            height: auto; /* Mantém a proporção */
            image-rendering: smooth; /* Suaviza o serrilhado */
            cursor: pointer;
            object-fit: contain;
            image-rendering: auto;
            will-change: transform;
         }
         .step p {
            margin-top: 10px;
            font-size: 13px;
         }
         .step::after {
            content: '\f105'; /* Ícone de seta para a direita do FontAwesome */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 24px;
            color: #216C2E;
            position: absolute;
            right: -25px;
            top: 50%;
            transform: translateY(-50%);
         }
         .step:last-child::after {
            content: '';
         }

         .contentg { text-align: center; margin: 0 auto}
         .contentg h3 {
            font-size: 24px;
            color: #333;
            font-weight: 600;
         }
         .contentg p { font-size: 15px; color: #555}
         .contentg h3 span {
            color: #216C2E;
         }

         .icospteps{
               height: 40px; 
               margin-top: 20px

         }

         .icon-verde {
                     filter: sepia(70%) saturate(200%) hue-rotate(90deg) brightness(90%);
                  }

         .icon-waht{
                  filter: sepia(100%) saturate(10%) hue-rotate(90deg) brightness(100%);
                  height: 20px; padding-right: 10px
         }

.icon-insta {
  filter: brightness(0) invert(1);
  height: 20px;
  padding-right: 10px;
}

         @media (max-width: 768px) {
            .comofunciona{

            }
            .comotext {
                  flex-direction: column; /* Empilha os elementos */
                  align-items: center;
                  text-align: center;
                  padding: 0;
            }

            .comofunciona-text {
                  margin-top: 80px;
                  width: 100%;
                  text-align: center;
                  margin-bottom: 20px; /* Dá espaço entre o título e os passos */
            }

            .steps {
                  width: 100%; /* Ocupa toda a largura disponível */
                  flex-direction: column;
                  align-items: center;
                  gap: 15px;
            }

            .step {
                  width: 90%;
                  max-width: 400px;
                  padding: 15px;
                  display: flex;
                  align-items: center;
                  text-align: left;
                  gap: 15px;
            }

            .step img {
                  width: 50px;
                  height: auto;
            }

            .step p {
                  margin: 0;
                  font-size: 14px;
                  flex: 1;
            }




            .profissionais-section {
                  flex-direction: column;
                  text-align: center;
            }



            .quadroesquerdo{

            }


         }




      </style>

   </head>

@if(session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        toastr.success("{{ session('success') }}");
    });
  </script>
@endif


   <body>
   <chat-hiia></chat-hiia>

      <header id="header" class="fixed-top header-transparent">
         <div class="container d-flex align-items-center hero-content">

         <div class="logo mr-auto">
            <a href="/"><img src="/assets/img/logotextopp.png" style="opacity: 0; padding: 13px 13px 13px 13px ; width: 250px"> </a>
      
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="/assets/img/logo.png" alt="" class="img-fluid"></a>-->
         </div>

         <nav class="nav-menu d-none d-lg-block">
            <ul>
                  <li class="active"><a href="#inicio">Início</a></li>
                  <li><a href="#about">Salas</a></li>          
                  <li><a href="#quemsomos">Sobre Nós</a></li>          
                  <li><a href="#team">Especialistas</a></li>          
                  <li><a href="#contato">Contato</a></li>     
                  <li>
                     @if(auth()->check())
                        @if(auth()->user()->tipo_usuario === 'admin')
                              <a href="{{ route('admin.dashboard') }}">Gestão</a>
                        @else
                              <a href="{{ route('cliente.reservas') }}">Minhas Reservas</a>
                        @endif
                     @else
                        <a href="{{ route('login') }}">Entre</a>
                     @endif
                  </li>
            </ul>
         </nav><!-- .nav-menu -->

         </div>
      </header>

      <section id="inicio" >
         <div class="text-overlay" style="margin-top: 60px" >
            <img src="/assets/img/logoescuro.png" alt="" class="logbanner" data-aos="fade" >
            <p style="font-size: 25px" >Espaço Coworking para Profissionais da Saúde</p>
            <p style="font-size: 20px" >
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pinned-icon lucide-map-pinned"><path d="M18 8c0 3.613-3.869 7.429-5.393 8.795a1 1 0 0 1-1.214 0C9.87 15.429 6 11.613 6 8a6 6 0 0 1 12 0"/><circle cx="12" cy="8" r="2"/><path d="M8.714 14h-3.71a1 1 0 0 0-.948.683l-2.004 6A1 1 0 0 0 3 22h18a1 1 0 0 0 .948-1.316l-2-6a1 1 0 0 0-.949-.684h-3.712"/></svg></span>
            Consolação - SP <br>Rua Dona Antônia de Queirós</p>

            <a href="https://wa.me/5511979691269?text=Olá%2C%20gostaria%20de%20saber%20mais%20sobre%20as%20salas." target="_blank" class="about-btn" style="margin-top: 30px">
                  <img src="/assets/img/icons/whats.png" alt="" class="icon-waht">
                  Chamar no Whats
            </a>
            
            
         </div>
         <div class="slides">
            <div class="slide active" style="background-image: url('/assets/img/salas/sala1.jfif');"></div>
            <div class="slide" style="background-image: url('/assets/img/salas/sala2.jfif');"></div>
            <div class="slide" style="background-image: url('/assets/img/salas/sala3.jfif');"></div>
            <div class="slide" style="background-image: url('/assets/img/salas/sala4.jfif');"></div>
         </div>
         <div class="dots">
            <span class="dot active" onclick="goToSlide(0)"></span>
            <span class="dot" onclick="goToSlide(1)"></span>
            <span class="dot" onclick="goToSlide(2)"></span>
            <span class="dot" onclick="goToSlide(3)"></span>
         </div>
      </section>

      <style>
         .item-sala { padding: 10px; }
         
         .card-sala {
            border-radius: 8px;
            overflow: hidden;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
         }

         .sala-imagem {
            width: 100%;
            height: 240px; /* Ajuste a altura como preferir */
            background-size: cover;
            background-position: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
         }

         .card-sala .content {
            padding: 10px 10px 15px 10px ;
         }


         .card-sala h4 { font-size: 18px }
         .textop{ font-size: 12px}



         .metragem {
            text-align: right;
         }

         .owl-nav-custom {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 10px;
         }

         .owl-prev-custom,
         .owl-next-custom {
            background: #216C2E;
            color: #fff;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: background 0.3s;
         }

         .owl-prev-custom:hover,
         .owl-next-custom:hover {
            background:rgb(115, 223, 133);
         }
         
      </style>
      <section id="about" class="about" style="margin-top: -40px">
         <div class="container">
            <div class="row">
                  <div class="content col-xl-12 d-flex align-items-stretch">
                     <div class="contentg">
                        <h3>Escolha <span>a melhor opção</span></h3>
                        <p>Espaços planejados para inspirar e proporcionar bem-estar, ambientes modernos, aconchegantes com conforto e praticidade.</p>
                     </div>
                  </div>
            </div>



            @if ($salas->count() > 0)
                  <div class="owl-nav-custom text-center mb-2">
                     <button class="owl-prev-custom">❮</button>
                     <button class="owl-next-custom">❯</button>
                  </div>
                  <div class="owl-carousel carousel-sala">
                     @foreach ($salas as $sala)
                        <div class="item-sala">
                              <div class="card-sala">
                                 @php
                                    $imagem = $sala->imagens->isNotEmpty() ? "url('{$sala->imagens->first()->imagem_base64}')" : "url('/img/default-sala.jpg')";
                                 @endphp
                                 <div class="sala-imagem" style="background-image: {{ $imagem }};"></div>
                                 <div class="content textop">
                                    <h4>{{ $sala->nome }}</h4>

                                    <div class="info-linha">
                                          <span>
                                             <img src="/assets/img/icons/mundo.png" class="icon-verde" style="width: 15px;">                            
                                             {{ $sala->endereco->bairro }}, {{ $sala->endereco->cidade }} - {{ $sala->endereco->estado }}
                                          </span>
                                          <span class="metragem">
                                             <img src="/assets/img/icons/metragem.png" class="icon-verde" style="width: 15px;">
                                             {{$sala->metragem}} m²
                                          </span>
                                    </div>

                                    <hr>

                                    <div class="info-linha">
                                          <span>
                                          <h4>R$ {{$sala->valor}}/h</h4>
                                          </span>
                                          <span class="metragem">
                                             <a href="{{ route('site.sala.detalhes', $sala->id) }}" class=" about-btn">Ver Detalhes</a>
                                          </span>
                                    </div>
                                 </div>
                              </div>
                        </div>
                     @endforeach
                  </div>
            @else
                  <p class="text-center">Nenhuma sala disponível no momento.</p>
            @endif
         </div>
         <div id="atendimento"></div>
      </section>


      <section id="comofunciona">
         <div class="container">
            <div class="comofunciona comotext" data-aos="fade">
                  <div class="comofunciona-text">
                  <h2>Como funciona nossa plataforma <span>para alugar as salas.</span></h2>            
                  </div>
                  <div class="steps">
                     <div class="step">
               
                        <img src="/assets/img/icons/mesa.png" alt="" class="icon-verde icospteps" style=""> 
                        <p>Escolha um dos nossos consultório disponiveis</p>
                     </div>
                     <div class="step">
                        <img src="/assets/img/icons/calendar.png" alt="" class="icon-verde icospteps" style=""> 
                        <p>Reserve os horários disponíveis</p>
                     </div>
                     <div class="step">
                        <img src="/assets/img/icons/cadastro.png" alt="" class="icon-verde icospteps" style=""> 
                        <p>Cadastre-se e pague com segurança</p>
                     </div>
                     <div class="step">
                        <img src="/assets/img/icons/mapa.png" alt="" class="icon-verde icospteps" style=""> 
                        <p>Vá até o consultório na data reservada</p>
                     </div>
                  </div>
            </div>
         </div>
      </section>

      <style>
         .profissionais-section {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
            padding: 40px 20px;
            flex-wrap: wrap;
         }

         /* Container alinhado corretamente */
         .profissionais-section .container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            width: 100%;
            position: relative;
         }

         /* Imagem no fundo */
         .image-box {
            width: 50%;
            height: 400px;
            background: url('/assets/img/960x0.jpg') center center no-repeat;
            background-size: cover;
            border-radius: 8px;
            position: absolute;
            left: 5%;
            z-index: 1;
         }

         /* Caixa de texto sobreposta */
         .profissionais-section .content {
            width: 45%;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            right: 5%;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
         }

         /* Lista de profissionais */
         .profissionais-section ul {
            list-style: none;
            padding: 0;
         }

         .profissionais-section ul li {
            font-size: 16px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
         }

         /* Ícones */
         .icon-prof {
            width: 30px;
            height: auto;
         }

         /* ✅ RESPONSIVO */
         @media (max-width: 768px) {
            .profissionais-section {
                  flex-direction: column;
                  text-align: center;
                  padding: 30px 15px;
            }

            .profissionais-section .container {
                  flex-direction: column;
                  align-items: center;
                  text-align: left;
                  position: relative;
            }

            .image-box {
                  width: 100%;
                  height: 450px;
                  border-radius: 10px;
                  position: relative;
                  left: 0;
                  z-index: 1;
                  margin-top: 0px;
            }

            .profissionais-section .content {
                  width: 90%;
                  padding: 20px;
                  position: absolute;
                  background: white;
                  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                  border-radius: 10px;
                  margin-top: 200px;
                  transform: translateY(-50%);
                  z-index: 2;
            }

            .profissionais-section ul li {
                  justify-content: left;
            }
            #faq{ 
                  margin-top: 180px !important;
            }

            /* Evita rolagem horizontal */
            body {
                  overflow-x: hidden;
            }
         }

      </style>

         <div class="container mb-3" data-aos="fade">
            <div class="content col-xl-12 d-flex align-items-stretch">
                  <div class="contentg">
                     <h3>Ofereça o melhor atendimento <span>para seus pacientes</span></h3>                    
                  </div>
            </div>
         </div>

      

         <section id="profissionais" class="profissionais-section">
            
            <div class="container" data-aos="fade">


                  <div class="image-box"></div> <!-- Imagem como fundo -->
                  
                  <div class="content quadroesquerdo">
                     <p>Atenda seus clientes em um ambiente confortável, sofisticado e privado. Nosso espaço é ideal para profissionais liberais da área da saúde, incluindo:</p>
                     
                     <ul>
                        <li><img src="/assets/img/icons/pisicologo.png" class="icon-verde icon-prof" style="width: 30px;"> Psicólogos</li>
                        <li><img src="/assets/img/icons/pisic.png" class="icon-verde icon-prof" style="width: 30px;"> Psiquiatras</li>
                        <li><img src="/assets/img/icons/tera.png" class="icon-verde icon-prof" style="width: 30px;"> Terapeutas</li>
                        <li><img src="/assets/img/icons/fisioterapia.png" class=" icon-verde icon-prof" style="width: 30px;"> Fisioterapeutas</li>
                        <li><img src="/assets/img/icons/nutricionista.png" class="icon-verde icon-prof" style="width: 30px;"> Nutricionistas</li>
                        <li><img src="/assets/img/icons/medico.png" class="icon-verde icon-prof" style="width: 30px;"> Médicos de diversas especialidades</li>
                     </ul>
                  </div>
            </div>
         </section>

      <style>
            .faq {
                  padding: 40px 20px;  
                  margin-top: -20px;
            }

            .faq h3 {
                  text-align: center;
                  margin-bottom: 20px;
            }

            .faq-item {
            border-radius: 5px;
                  margin-bottom: 10px;
                  overflow: hidden;
                  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }

            .faq-question {
                  width: 100%;
                  padding: 15px;
                  background: #fff;
                  color: #444;
                  border: none;
                  text-align: left;
                  font-size: 16px;
                  cursor: pointer;
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
            }

            .faq-question .arrow {
                  font-size: 18px;
            }

            .faq-answer {
                  max-height: 0;
                  overflow: hidden;
                  padding: 0 10px;
                  transition: max-height 0.3s ease, padding 0.3s ease;
                  background: white;
            }

            .faq-answer p {
                  padding: 0;
                  font-size: 14px;
                  color: #777;
                  margin-top: -20px;
            }

      </style>
      <section id="faq" class="faq mt-3" data-aos="fade">
         <div class="container">
            <div class="row">
                  <div class="content col-xl-12 d-flex align-items-stretch">
                     <div class="contentg">
                        <h3>Algumas das perguntas<span> frequentes</span></h3>                    
                     </div>
                  </div>
            </div>

            <div class="faq-item">
                  <button class="faq-question">Como faço para reservar uma sala? <span class="arrow">+</span></button>
                  <div class="faq-answer">
                     <p>Para reservar uma sala, basta acessar nossa página, escolher a unidade desejada e selecionar a opção "Reservar".</p>
                  </div>
            </div>

            <div class="faq-item">
                  <button class="faq-question">Quais são os métodos de pagamento aceitos? <span class="arrow">+</span></button>
                  <div class="faq-answer">
                     <p>Aceitamos pagamentos via cartão de crédito, boleto bancário e transferência PIX.</p>
                  </div>
            </div>

            <div class="faq-item">
                  <button class="faq-question">Posso cancelar minha reserva? <span class="arrow">+</span></button>
                  <div class="faq-answer">
                     <p>Sim, é possível cancelar sua reserva com até 24 horas de antecedência para reembolso total.</p>
                  </div>
            </div>

         </div>
      </section>


      
      <!-- ======= Quem somos ======= -->
      <section id="quemsomos" class="team bg-quemsomos" style="background: #f5f3f1">
      <div class="container">

         <div class="row">
            <div class="content col-xl-12 d-flex ">
                  <div class="contentg" >
                     <h3>Um pouco <span>Sobre nós</span></h3>
                     <p class="mt-5" style=" text-align: left !important;">
                        Em um mundo cada vez mais acelerado e exigente, cuidar da saúde emocional tornou-se uma prioridade. Foi com esse propósito que as psicólogas clínicas <strong>Rosiane Camelo</strong> e <strong>Jiciléia Oliveira</strong> fundaram o <strong>Espaço EquilibraMente</strong> — um ambiente pensado com carinho para acolher profissionais da saúde mental e seus pacientes.
                     </p>
                     <p style=" text-align: left !important;">
                        O Espaço oferece salas aconchegantes, silenciosas e bem equipadas, disponíveis para locação por hora, proporcionando uma estrutura de qualidade para atendimentos presenciais ou online. Nosso objetivo é garantir um ambiente onde o bem-estar, a privacidade e a qualidade no atendimento caminham lado a lado.
                     </p>
                     <p style=" text-align: left !important;">
                        Aqui, cada detalhe foi pensado para que você possa cuidar de quem cuida.
                     </p>                    
                  </div>

            </div>
         </div>

             <div id="portfolio" class="portfolio">
      <div class="container">



        <div class="row" data-aos="fade-in">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter=".filter-app" class="filter-active">sala 1</li>
              <li data-filter=".filter-card">sala 2</li>
              <li data-filter=".filter-web">sala 3</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">


          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="/assets/img/salas/sala12.jfif" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="/assets/img/salas/sala12.jfif" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="bx bx-plus"></i></a>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="/assets/img/salas/sala13.jfif" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="/assets/img/salas/sala13.jfif" data-gall="portfolioGallery" class="venobox" title="App 2"><i class="bx bx-plus"></i></a>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="/assets/img/salas/sala14.jfif" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="/assets/img/salas/sala14.jfif" data-gall="portfolioGallery" class="venobox" title="Card 2"><i class="bx bx-plus"></i></a>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="/assets/img/salas/sala21.jfif" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="/assets/img/salas/sala21.jfif" data-gall="portfolioGallery" class="venobox" title="Web 2"><i class="bx bx-plus"></i></a>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="/assets/img/salas/sala31.jfif" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="/assets/img/salas/sala31.jfif" data-gall="portfolioGallery" class="venobox" title="App 3"><i class="bx bx-plus"></i></a>
                
              </div>
            </div>
          </div>



        </div>

      </div>
    </div>

         </div>
      </section>

      <section id="sobre" class="testimonials" style="padding:10px; margin:0; background: #fafafa !important" data-aos="fade">
         <div class="container mt-5">

         <div class=" mb-5" data-aos="fade-in" data-aos-delay="100">


            <div class="contentg">
                  <h3>O que dizem das <span> nossas salas</span></h3>
                  <p>Nossos espaços foram cuidadosamente planejados para atender às necessidades de profissionais das mais diversas áreas, como psicólogos, terapeutas, coaches, e muitos outros. Veja o que alguns de nossos parceiros têm a dizer sobre suas experiências:</p>
            </div>

            
         </div>

         <div class="owl-carousel testimonials-carousel">

            <div class="testimonial-item" data-aos="fade-up">
                  <p>
                     <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #216C2E;"></i>
                     As salas são perfeitas para atender meus pacientes. O ambiente é acolhedor e profissional, exatamente o que eu precisava para oferecer um serviço de qualidade.
                     <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #216C2E;"></i>
                  </p>
                  <h3>Dr. Ricardo Almeida</h3>
                  <h4>Psicólogo</h4>
            </div>


            <div class="testimonial-item" data-aos="fade-up">
                  <p>
                     <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #216C2E;"></i>
                     Encontrei um espaço incrível para realizar minhas terapias. A organização e a estrutura são impecáveis, e meus clientes também elogiam.
                     <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #216C2E;"></i>
                  </p>
                  <h3>Maria Beatriz Rocha</h3>
                  <h4>Terapeuta</h4>
            </div>


            <div class="testimonial-item" data-aos="fade-up">
                  <p>
                     <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #216C2E;"></i>
                     Atender aqui é um diferencial. A flexibilidade de horários e a infraestrutura moderna me ajudam a causar uma ótima impressão nos meus clientes.
                     <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #216C2E;"></i>
                  </p>
                  <h3>Paulo Mendes</h3>
                  <h4>Terapeuta</h4>
            </div>


            <div class="testimonial-item" data-aos="fade-up">
                  <p>
                     <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #216C2E;"></i>
                     A localização estratégica e o ambiente organizado me ajudam a fidelizar meus clientes. Recomendo para qualquer profissional da área da saúde.
                     <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #216C2E;"></i>
                  </p>
                  <h3>Luiza Martins</h3>
                  <h4>Nutricionista</h4>
            </div>


            <div class="testimonial-item" data-aos="fade-up">
                  <p>
                     <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #216C2E;"></i>
                     As salas atendem perfeitamente às minhas necessidades. Conforto e privacidade para os atendimentos são pontos fortes do espaço.
                     <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #216C2E;"></i>
                  </p>
                  <h3>Juliana Torres</h3>
                  <h4>Psicopedagoga</h4>
            </div>


         </div>

         </div>
      </section>







         
      <!-- ======= Especialistas ======= -->

      <style>
         .especialista-bloco {
         margin-bottom: 4rem;
         }

         .especialista-img img {
         max-height: 400px;
         object-fit: cover;
         border-radius: 10px;
         box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
         width: 100%;
         height: auto;
         }

         .especialista-texto h4 {
         font-weight: bold;
         margin-bottom: 1rem;
         font-size: 1.5rem;
         color: #333;
         }

         .especialista-texto p {
         font-size: 1rem;
         color: #444;
         line-height: 1.6;
         }


      </style>
      <section id="team" class="team" style="background: #eee">
      <div class="container">

         <div class="contentg">
            <h3>Nossos time de <span>Especialistas</span></h3>
            <p>
               Nosso time é formado por profissionais experientescomprometidas com o cuidado emocional, garantindo qualidade no atendimento e cuidado com cada detalhe.
            </p>

           
         </div>

            <!-- Rosiane -->
            <div class="row especialista-bloco align-items-center mt-5">
               <div class="col-lg-4">
                  <img src="assets/img/team/rose.jpeg" class="img-fluid rounded shadow" alt="Rosiane Camelo">
               </div>
               <div class="col-lg-6 especialista-texto">
                  <h4>Rosiane Camelo</h4>
                  <p>
                     Psicóloga clínica com formação em Psicologia e Pós-Graduação em Terapia de Relacionamentos. Com mais de 10 anos de experiência na abordagem psicanalítica, é fundadora do Espaço EquilibraMente, um ambiente dedicado à saúde mental. Oferece atendimento personalizado e especializado em psicologia clínica, promovendo o bem-estar e o equilíbrio emocional de seus pacientes.
                  </p>
                  <p>
                     <a href="https://wa.me/5511986428238" target="_blank" style="text-decoration: none; color: inherit;">
                     <img src="/assets/img/icons/whats.png" alt="WhatsApp" class="icon-waht" style="margin-right: 5px;">
                     <strong>(11) 98642-8238</strong>
                     </a><br>
               
                  </p>
               </div>
            </div>

            <hr class="mb-5">

            <!-- Jicileia -->
            <div class="row especialista-bloco align-items-center flex-lg-row-reverse">
               <div class="col-lg-4">
                  <img src="assets/img/team/ji.jpg" class="img-fluid rounded shadow" alt="Jicileia Oliveira">
               </div>
               <div class="col-lg-6 especialista-texto">
                  <h4>Jicileia Oliveira</h4>
                  <p>
                     Psicóloga clínica com mais de 9 anos de experiência, atuando com abordagem psicanalítica. Pós-graduada em Neuropsicanálise, integra conhecimentos da psicanálise e da neurociência para um cuidado mais profundo e individualizado. Especializada em prevenção ao suicídio, ansiedade e depressão. Fundadora do Espaço EquilibraMente, um ambiente voltado ao acolhimento e à saúde emocional com ética, escuta e sensibilidade.
                  </p>
                  <p>
                  <a href="https://wa.me/5511944751511" target="_blank" style="text-decoration: none; color: inherit;">
                     <img src="/assets/img/icons/whats.png" alt="WhatsApp" class="icon-waht" style=" margin-right: 5px;">
                     <strong>(11) 94475-1511</strong>
                  </a><br>
         
                  </p>
               </div>
            </div>

            <hr class="mb-5">

            <!-- Cristina Azeved -->
            <div class="row especialista-bloco align-items-center mt-5">
               <div class="col-lg-4">
                  <img src="assets/img/team/cristina.jpg" class="img-fluid rounded shadow" alt="Cristina Azeved">
               </div>
               <div class="col-lg-6 especialista-texto">
                  <h4>Cristina Azevedo</h4>
                  <p>
                     Psicóloga Clínica com mais de 5 anos de experiência em Terapia Cognitivo-Comportamental. Pós-graduanda em Neuropsicologia. Trabalha com avaliações e intervenções personalizadas.

                  </p>
                  <p>
                     <a href="https://wa.me/5511915654166" target="_blank" style="text-decoration: none; color: inherit;">
                     <img src="/assets/img/icons/whats.png" alt="WhatsApp" class="icon-waht" style="margin-right: 5px;">
                     <strong>(11) 91565-4166</strong>
                     </a><br>
               
                  </p>
               </div>
            </div>

            <hr class="mb-5">

            <!-- Jicileia -->
            <div class="row especialista-bloco align-items-center flex-lg-row-reverse">
               <div class="col-lg-4">
                  <img src="assets/img/team/djane.jpg" class="img-fluid rounded shadow" alt="Djane">
               </div>
               <div class="col-lg-6 especialista-texto">
                  <h4>Djane </h4>
                  <p>
                     Psicopedagoga e Neuropsicopedagoga especializada no atendimento a crianças, jovens e adultos com TDAH, TEA e dificuldades de aprendizagem. Oferece avaliação, intervenção e orientação educacional personalizada.

                  </p>
                  <p>
                  <a href="https://wa.me/5511972396456" target="_blank" style="text-decoration: none; color: inherit;">
                     <img src="/assets/img/icons/whats.png" alt="WhatsApp" class="icon-waht" style=" margin-right: 5px;">
                     <strong>(11) 97239-6456</strong>
                  </a><br>
         
                  </p>
               </div>
            </div>



      </div>
      </section><!-- End Especialistas -->

<section id="contato" style="background: #fafafa; padding: 50px 0">
  <div class="container" data-aos="fade-up">
    <div class="contentg mb-4">
      <h3>Fale <span>Conosco</span></h3>
      <p>Entre em contato com nosso time através do WhatsApp ou siga nosso Instagram para acompanhar as novidades.</p>
    </div>

    <div class="row justify-content-center text-center">

      <div class="col-lg-4 col-md-6 mb-4">
        <a href="https://wa.me/5511986428238" target="_blank" class="about-btn">
          <img src="/assets/img/icons/whats.png" alt="" class="icon-waht">
          Rosiane - (11) 98642-8238
        </a>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <a href="https://wa.me/5511944751511" target="_blank" class="about-btn">
          <img src="/assets/img/icons/whats.png" alt="" class="icon-waht">
          Jicileia - (11) 94475-1511
        </a>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <a href="https://www.instagram.com/espaco_equilibramente" target="_blank" class="about-btn">
          <img src="/assets/img/icons/instagram.png" alt="" class="icon-insta">
          @espaco_equilibramente
        </a>
      </div>

    </div>
  </div>
</section>



      <footer id="footer" class="mt-5">
         <div class="footer-top">
         <div class="container">
         <div class="row">

            <div class="col-lg-4 col-md-6">
            <div class="footer-info" data-aos="fade-up" data-aos-delay="50">
                  <img src="/assets/img/logoescuro.png" alt="" class="img-fluid mb-4" style=" width: 70%;"> 
                  <div class="social-links mt-3">
                  <a href="https://www.facebook.com/share/16PuqyqkeM/?mibextid=wwXIfr" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                  <a href="https://www.instagram.com/espaco_equilibramente?igsh=dG03Z3pid2hpYmFk" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/espa%C3%A7o-equilibra-mente-99a439368?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                  </div>
            </div>
            </div>

            <div class="col-lg-4 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="250">
                  <h4>Nossos Serviços </h4>
                  <ul>
                     <li><i class="bx bx-chevron-right"></i> Atendimento Personalizado</li>
                     <li><i class="bx bx-chevron-right"></i> Aluguel de Salas</li>
                     <li><i class="bx bx-chevron-right"></i> Espaços para Eventos</li>
                     <li><i class="bx bx-chevron-right"></i> Salas de Reunião</li>                  
                     <li><i class="bx bx-chevron-right"></i> Ambientes Equipados</li>
               

                  </ul>
            </div>


            <div class="col-lg-4 col-md-6 footer-newsletter" data-aos="fade-up" data-aos-delay="350">
            <h4>Inscreva-se na nossa Newsletter</h4>
            <p>Fique por dentro das nossas novidades, disponibilidade e atualizações das salas.</p>
            <form action="/newsletter" method="post">
                  @csrf
                  <input type="email" name="email"><input type="submit" value="Inscrever-se">
            </form>
            </div>

         </div>
         </div>
         </div>

      </footer>

   <!-- End Footer -->

   <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

   <!-- Vendor JS Files -->
   <script src="/assets/vendor/jquery/jquery.min.js"></script>
   <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
   <script src="/assets/vendor/php-email-form/validate.js"></script>
   <script src="/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
   <script src="/assets/vendor/counterup/counterup.min.js"></script>
   <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
   <script src="/assets/vendor/venobox/venobox.min.js"></script>
   <script src="/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
   <script src="/assets/vendor/aos/aos.js"></script>
   <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>

   <!-- Template Main JS File -->
   <script src="/assets/js/main.js"></script>
   <script>
      //banner
      let currentIndex = 0;
      const slides = document.querySelectorAll('.slide');
      const dots = document.querySelectorAll('.dot');
      const totalSlides = slides.length -1;

      // Verifica se há slides suficientes para evitar erros
      if (totalSlides > 0) {
         function goToSlide(index) {
            // Remove a classe 'active' de todos os slides e dots
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Atualiza o índice e adiciona a classe 'active' ao slide correto
            currentIndex = index % totalSlides;
            slides[currentIndex].classList.add('active');
            dots[currentIndex].classList.add('active');
         }

         function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides; // Garante o loop correto
            goToSlide(currentIndex);
         }

         // Inicia o loop do banner
         setInterval(nextSlide, 5000);

         // Ativa o primeiro slide ao carregar a página
         goToSlide(0);
      } else {
         console.error("Erro: Nenhum slide encontrado!");
      }

      $(document).ready(function () {
         $('form[action="/newsletter"]').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let email = form.find('input[name="email"]').val();
            let token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                  url: '/newsletter',
                  method: 'POST',
                  data: {
                     _token: token,
                     email: email
                  },
                  success: function (data) {
                     if (data.success) {
                        toastr.success(data.message || 'E-mail cadastrado com sucesso!');
                        form[0].reset();
                     } else {
                        toastr.error(data.message || 'Erro ao cadastrar e-mail.');
                     }
                  },
                  error: function (xhr) {
                     let erro = xhr.responseJSON?.message || 'Erro no servidor.';
                     toastr.error(erro);
                  }
            });
         });
      });

      document.querySelectorAll('.faq-question').forEach(button => {
         button.addEventListener('click', () => {
            const answer = button.nextElementSibling;
            const isOpen = answer.style.maxHeight;

            // Fecha todas as respostas antes de abrir outra
            document.querySelectorAll('.faq-answer').forEach(item => {
                  item.style.maxHeight = null;
                  item.style.padding = "0 15px";
                  item.previousElementSibling.querySelector('.arrow').textContent = "+";
            });

            // Se não estava aberto, abre a resposta
            if (!isOpen || isOpen === "0px") {
                  answer.style.maxHeight = answer.scrollHeight + "px";
                  answer.style.padding = "15px";
                  button.querySelector('.arrow').textContent = "−";
            }
         });
      });

      //carrocel das salas
      $(document).ready(function(){
         let $carousel = $('.carousel-sala').owlCarousel({
            loop: true,
            margin: 15,
            nav: false, // desativa as setas nativas
            dots: false,
            responsive: {
                  0: { items: 1 },
                  768: { items: 2 },
                  992: { items: 3 },
                  1200: { items: 4 }
            }
         });

         // seta personalizada
         $('.owl-prev-custom').click(function() {
            $carousel.trigger('prev.owl.carousel');
         });

         $('.owl-next-custom').click(function() {
            $carousel.trigger('next.owl.carousel');
         });
      });



   </script>




   </body>

   </html>