<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Espaço Equilibra Mente - site</title>
<!-- Open Graph Meta Tags (para Facebook, WhatsApp e outros) -->
<meta property="og:title" content="Espaço Equilibra Mente - Aluguel de Salas Modernas" />
<meta property="og:description" content="Descubra o espaço perfeito para reuniões, eventos e atendimentos. Salas modernas, bem localizadas e totalmente equipadas." />
<meta property="og:image" content="https://www.espacoequilibramente.com.br/storage/salas/Zw0ghOj1uwjwFU5xI7zbIZSEVkLCX48eHjAyP7mg.jpg" />
<meta property="og:url" content="https://www.espacoequilibramente.com.br/" />
<meta property="og:type" content="website" />

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Espaço Equilibra Mente - Aluguel de Salas Modernas" />
<meta name="twitter:description" content="Descubra o espaço perfeito para reuniões, eventos e atendimentos. Salas modernas, bem localizadas e totalmente equipadas." />
<meta name="twitter:image" content="https://www.espacoequilibramente.com.br/storage/salas/Zw0ghOj1uwjwFU5xI7zbIZSEVkLCX48eHjAyP7mg.jpg" /> 
<!-- Meta Tags para SEO -->
<meta name="description" content="Descubra o espaço perfeito para o seu próximo evento, reunião ou atendimento. Salas modernas, bem localizadas e equipadas para atender suas necessidades." />
<meta name="keywords" content="aluguel de salas, salas para eventos, salas para reuniões, espaço para workshops, Equilibra Mente" />
<meta name="author" content="Espaço Equilibra Mente" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

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
          <li class="active"><a href="#hero">Home</a></li>
          <li><a href="#about">Salas</a></li>
          <li><a href="#sobre">Sobre Nós</a></li>
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

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="fade-up">
      <div class="row divheropaddd" style="">
        <div class="content col-md-6 centercont" data-aos="fade-up" >
          <img src="/assets/img/logoescuro.png" alt="" class="img-fluid logohero" > 
          <h1 class="h1hero">Aluguel de Salas Modernas e Bem Localizadas para seus Negócios</h1>
          <a href="#about" class="btn-get-started scrollto mt-3"><i class="bx bx-chevrons-down"></i></a>

          
        </div>
        <div class="col-md-6" style=" padding:0; margin:0"> 
          <img src="/assets/img/sala1.jpg" alt="" class="img-fluid imgboxhero"> 
        </div>
        <div class="col-md-12"> 
            
        </div>
      </div>
    
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="row no-gutters">
          <div class="content col-xl-12 d-flex align-items-stretch" data-aos="fade-up">
            <div class="content">
              <h3>Nossas Unidades</h3>
              <p>Descubra o espaço perfeito para o seu próximo evento, reunião ou atendimento. Oferecemos salas modernas e bem equipadas, projetadas para atender às suas necessidades profissionais, sejam elas pequenas reuniões, sessões individuais ou workshops. Confira as opções disponíveis e encontre o ambiente ideal para você e seus clientes.</p>
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
    <section id="sobre" class="testimonials section-bg">
      <div class="container">

        <div class=" mb-5" data-aos="fade-in" data-aos-delay="100">

          <h3>Sobre Nós</h3>   
          <p class="mb-5">Somos uma empresa dedicada a oferecer espaços modernos, práticos e confortáveis para profissionais e empresas que buscam ambientes ideais para atender seus clientes ou realizar reuniões e eventos. Nosso objetivo é criar uma experiência única, onde cada detalhe foi pensado para proporcionar funcionalidade e bem-estar. <br>

Com salas totalmente equipadas, flexibilidade de horários e localização estratégica, atendemos às necessidades de psicólogos, terapeutas, coaches, empresários e diversos outros profissionais. Seja para um atendimento individual, um workshop ou uma reunião corporativa, aqui você encontra o ambiente perfeito para alcançar seus objetivos.<br>

Nossa missão é simplificar sua rotina e oferecer o suporte que você precisa para focar no que realmente importa: seus clientes e negócios.

Venha conhecer nossas salas e transforme seu dia a dia profissional com um espaço feito para você!</p>

<hr>

          <h3 class="mt-5">O que dizem do nossos espaço</h3>     
          <p>Nossos espaços foram cuidadosamente planejados para atender às necessidades de profissionais das mais diversas áreas, como psicólogos, terapeutas, coaches, e muitos outros. Aqui, cada detalhe foi pensado para garantir conforto, praticidade e um ambiente profissional. Veja o que alguns de nossos parceiros têm a dizer sobre suas experiências:</p>
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
              <h4>Nossos Serviços</h4>
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
            <form action="" method="post">
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

</body>

</html>