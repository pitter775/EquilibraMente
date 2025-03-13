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
            background: rgba(0, 0, 0, 0.7);
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
            filter: brightness(.8) invert(1);
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
            background: white;
            padding: 50px;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            box-shadow: 0px -15px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
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
            background: #f8f8f8;
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
            font-size: 20px;
            color: #333;
            font-weight: 600;
        }
        .contentg p { font-size: 13px}
        .contentg h3 span {
            color: #216C2E;
        }
    </style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center hero-content">

      <div class="logo mr-auto">
        <a href="/"><img src="/assets/img/logofinoescuro.png" style="height: 30px; opacity: 0;"> </a>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="/assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#inicio">Início</a></li>
          <li><a href="#about">Como usar</a></li>
          <li><a href="#about">Diferencias</a></li>
          <li><a href="#about">Salas</a></li>          
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
  </header><!-- End Header -->


      <section id="inicio">
        <div class="text-overlay">
          <img src="/assets/img/logoescuro.png" alt="" class="logbanner">
          <p style="font-size: 25px">Salas com Infraestrutura completa, conforto e segurança para o seu melhor atendimento.</p>
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
    <section id="comofunciona">
        <div class="container">
            <div class="comofunciona comotext">
                <div class="comofunciona-text">
                  <h2>Como funciona nossa plataforma <span>para alugar as salas.</span></h2>            
                </div>
                <div class="steps">
                    <div class="step">
                        <i class='bx bxs-institution'></i>
                        <p>Encontre o consultório ideal</p>
                    </div>
                    <div class="step">
                        <i class="bx bx-calendar"></i>
                        <p>Reserve os horários disponíveis</p>
                    </div>
                    <div class="step">
                        <i class="bx bx-lock"></i>
                        <p>Cadastre-se e pague com segurança</p>
                    </div>
                    <div class="step">
                        <i class='bx bxs-navigation'></i>
                        <p>Vá até o consultório na data reservada</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about" style="margin-top: -40px">
      <div class="container">
        <div class="row no-gutters">
          <div class="content col-xl-12 d-flex align-items-stretch" data-aos="fade-up">
            <div class="contentg">
              <h3>Escolha <span> a melhor opção</span></h3>
              <p>Todas as unidades estão situadas em regiões próximas às estações e com fácil acesso.</p>
            </div>
          </div>
        </div>

        <div class="row">
          @foreach($salas as $sala)
            <div class="col-md-6 icon-box m-0 p-0" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
              
              
              <div class="card m-3 cardunidades">
                <!-- Carrossel de Imagens da Sala com Intervalo Personalizado -->
                @if($sala->imagens->isNotEmpty())
                  <div id="carouselSala{{ $sala->id }}" class="carousel slide" data-ride="carousel" data-interval="{{ 10000 + ($loop->index * 1000) }}">
                    <div class="carousel-inner">
                      @foreach($sala->imagens as $index => $imagem)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                          <img src="{{ $imagem->imagem_base64 }}" class="d-block w-100" alt="{{ $sala->nome }}">
                        </div>
                      @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselSala{{ $sala->id }}" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselSala{{ $sala->id }}" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Próximo</span>
                    </a>
                  </div>
                @endif
                <div class="p-4">
                  <h4 class='mt-3'>{{ $sala->nome }}</h4>
                  <p>{!! \Illuminate\Support\Str::limit($sala->descricao, 100, '...') !!}</p>
                  <a href="{{ route('site.sala.detalhes', $sala->id) }}" class="about-btn">Ver Detalhes e Reservar <i class="bx bx-chevron-right"></i></a>
                </div>
               
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="sobre" class="testimonials section-bg" style="padding:10px; margin:0">
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
                  <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #ff5722;"></i>
                  As salas são perfeitas para atender meus pacientes. O ambiente é acolhedor e profissional, exatamente o que eu precisava para oferecer um serviço de qualidade.
                  <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #ff5722;"></i>
              </p>
              <h3>Dr. Ricardo Almeida</h3>
              <h4>Psicólogo</h4>
          </div>


          <div class="testimonial-item" data-aos="fade-up">
              <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #ff5722;"></i>
                  Encontrei um espaço incrível para realizar minhas terapias. A organização e a estrutura são impecáveis, e meus clientes também elogiam.
                  <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #ff5722;"></i>
              </p>
              <h3>Maria Beatriz Rocha</h3>
              <h4>Terapeuta</h4>
          </div>


          <div class="testimonial-item" data-aos="fade-up">
              <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #ff5722;"></i>
                  Atender aqui é um diferencial. A flexibilidade de horários e a infraestrutura moderna me ajudam a causar uma ótima impressão nos meus clientes.
                  <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #ff5722;"></i>
              </p>
              <h3>Paulo Mendes</h3>
              <h4>Terapeuta</h4>
          </div>


          <div class="testimonial-item" data-aos="fade-up">
              <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #ff5722;"></i>
                  A localização estratégica e o ambiente organizado me ajudam a fidelizar meus clientes. Recomendo para qualquer profissional da área da saúde.
                  <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #ff5722;"></i>
              </p>
              <h3>Luiza Martins</h3>
              <h4>Nutricionista</h4>
          </div>


          <div class="testimonial-item" data-aos="fade-up">
              <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"style="color: #ff5722;"></i>
                  As salas atendem perfeitamente às minhas necessidades. Conforto e privacidade para os atendimentos são pontos fortes do espaço.
                  <i class="bx bxs-quote-alt-right quote-icon-right"style="color: #ff5722;"></i>
              </p>
              <h3>Juliana Torres</h3>
              <h4>Psicopedagoga</h4>
          </div>


        </div>

      </div>
    </section><!-- End Testimonials Section -->
    <!-- ======= Contact Section ======= -->

    
    <!-- End Contact Section -->

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
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

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Equilibra Mente</span></strong>. Todos os direitos reservados.
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
        
        function goToSlide(index) {
            slides[currentIndex].classList.remove('active');
            dots[currentIndex].classList.remove('active');
            currentIndex = index;
            slides[currentIndex].classList.add('active');
            dots[currentIndex].classList.add('active');
        }
        
        function nextSlide() {
            let nextIndex = (currentIndex + 1) % slides.length;
            goToSlide(nextIndex);
        }
        
        setInterval(nextSlide, 5000); // Troca automática a cada 3 segundos


        // fim banner



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
</script>




</body>

</html>