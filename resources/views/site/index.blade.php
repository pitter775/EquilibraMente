<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="theme-color" content="#556050"> 

  <title>Espaço Equilibra Mente - site</title>
  <!-- Open Graph Meta Tags (para Facebook, WhatsApp e outros) -->
  <meta property="og:title" content="Espaço Equilibra Mente - Aluguel de Salas Modernas" />
  <meta property="og:description" content="Descubra o espaço perfeito para reuniões, eventos e atendimentos. Salas modernas, bem localizadas e totalmente equipadas." />
  <meta property="og:image" content="https://equilibramente-production.up.railway.app/assets/img/sala1.jpg" />
  <meta property="og:url" content="https://www.espacoequilibramente.com.br/" />
  <meta property="og:type" content="website" />

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Espaço Equilibra Mente - Aluguel de Salas Modernas" />
  <meta name="twitter:description" content="Descubra o espaço perfeito para reuniões, eventos e atendimentos. Salas modernas, bem localizadas e totalmente equipadas." />
  <meta name="twitter:image" content="https://equilibramente-production.up.railway.app/assets/img/sala1.jpg" /> 


  <!-- Meta Tags para SEO -->
  <meta name="description" content="Descubra o espaço perfeito para o seu próximo evento, reunião ou atendimento. Salas modernas, bem localizadas e equipadas para atender suas necessidades." />
  <meta name="keywords" content="aluguel de salas, salas para eventos, salas para reuniões, espaço para workshops, Equilibra Mente" />
  <meta name="author" content="Espaço Equilibra Mente" />

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


    </style>

</head>

<body>


    <header id="header" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center hero-content">

        <div class="logo mr-auto">
            <a href="/"><img src="/assets/img/logotextopp.png" style="opacity: 0;"> </a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="/assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="#inicio">Início</a></li>
                <li><a href="#about">Salas</a></li>          
                <li><a href="#atendimento">Atendimento</a></li>          
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

            <a href="#" class=" about-btn" style="margin-top: 30px">  <img src="/assets/img/icons/whats.png" alt="" class="icon-waht" style="" > Chamar no Whats </a>
           
            
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
                                            35 m²
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
        }

        .profissionais-section .container {
        
            display: flex;
            align-items: center;
            position: relative;
            justify-content: center;
        }

        /* Imagem no fundo */
        .image-box {
            width: 50%;
            height: 400px;
            background: url('/assets/img/960x0.jpg') center center no-repeat;
            background-size: cover; /* Maior para preencher melhor */
            border-radius: 8px;
            position: absolute;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Caixa de texto sobreposta */
        .profissionais-section .content {
            width: 50%;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            position: relative;
            z-index: 2; /* Para ficar acima da imagem */
            
            margin-left: 40%; /* Move a div um pouco para a direita */
        }

        .profissionais-section h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .profissionais-section ul {
            list-style: none;
            padding: 0;
        }

        .profissionais-section ul li {
            font-size: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .profissionais-section .container {
                flex-direction: column;
                text-align: center;
            }

            .image-box {
                width: 100%;
                height: 250px;
                position: static;
                transform: none;
            }

            .profissionais-section .content {
                width: 100%;
                padding: 20px;
            }
        }

    </style>

        <div class="container" data-aos="fade">
            <div class="content col-xl-12 d-flex align-items-stretch">
                <div class="contentg">
                    <h3>Ofereça o melhor atendimento <span>para seus pacientes</span></h3>                    
                </div>
            </div>
        </div>

      

        <section id="profissionais" class="profissionais-section">
            
            <div class="container" data-aos="fade">


                <div class="image-box"></div> <!-- Imagem como fundo -->
                
                <div class="content">
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
    <section id="faq" class="faq" data-aos="fade">
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

    <section id="sobre" class="testimonials section-bg" style="padding:10px; margin:0" data-aos="fade">
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

    <footer id="footer">
    <div class="footer-top">
        <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
            <div class="footer-info" data-aos="fade-up" data-aos-delay="50">
                <img src="/assets/img/logoescuro.png" alt="" class="img-fluid mb-4" style=" width: 70%;"> 
                <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
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
            <p>Fique por dentro das nossas ofertas, disponibilidade e Atualizações das salas.</p>
            <form action="/newsletter" method="post">
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





    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form[action="/newsletter"]');

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            const email = form.querySelector('input[name="email"]').value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/newsletter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token // Adiciona o token CSRF
                },
                body: JSON.stringify({ email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message || 'E-mail cadastrado com sucesso!');
                    form.reset(); // Limpa o campo do formulário
                } else {
                    toastr.error(data.message || 'Ocorreu um erro ao cadastrar o e-mail.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                toastr.error('Erro no servidor. Tente novamente mais tarde.');
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



  </script>




</body>

</html>