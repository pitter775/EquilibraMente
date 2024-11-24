<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Squadfree Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets') }}/img/favicon.png" rel="icon">
  <link href="{{ asset('assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('assets') }}/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{ asset('assets') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('assets') }}/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="{{ asset('assets') }}/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ asset('assets') }}/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Squadfree - v2.3.1
  * Template URL: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center hero-content">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="/"><span>Equilibra Mente</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="{{ asset('assets') }}/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#hero">Home</a></li>
          <li><a href="#about">Salas</a></li>
          <li><a href="#contact">Contato</a></li>
             <li>
              @if(auth()->check())
                  @if(auth()->user()->tipo_usuario === 'admin')
                      <a href="{{ route('admin.dashboard') }}">Painel Admin</a>
                  @else
                      <a href="{{ route('cliente.reservas') }}">Painel Cliente</a>
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
      <div class="row no-gutters" style=" margin-top: 100px; padding: 60px">
        <div class="content col-md-6 centercont" data-aos="fade-up" >
          <img src="{{ asset('assets') }}/img/logoescuro.png" alt="" class="img-fluid" style=" width: 60%"> 
          <h1 style="padding-top: 50px">Salas Modernas e Bem Localizadas para seus Negócios</h1>
          <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>

          
        </div>
        <div class="col-md-6" style=" padding-top: 80px"> 
          <img src="{{ asset('assets') }}/img/sala1.jpg" alt="" class="img-fluid" style=" "> 
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
              <p>Confira as salas disponíveis para o seu próximo evento ou reunião.</p>
            </div>
          </div>
        </div>

        <div class="row">
          @foreach($salas as $sala)
            <div style="padding: 40px" class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
              
              <h4>{{ $sala->nome }}</h4>

              <!-- Carrossel de Imagens da Sala com Intervalo Personalizado -->
              @if($sala->imagens->isNotEmpty())
                <div id="carouselSala{{ $sala->id }}" class="carousel slide" data-ride="carousel" data-interval="{{ 10000 + ($loop->index * 1000) }}">
                  <div class="carousel-inner">
                    @foreach($sala->imagens as $index => $imagem)
                      <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $imagem->path) }}" class="d-block w-100" alt="{{ $sala->nome }}">
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

              <p>{!! \Illuminate\Support\Str::limit($sala->descricao, 100, '...') !!}</p>
              <a href="{{ route('site.sala.detalhes', $sala->id) }}" class="about-btn">Ver Detalhes e Reservar <i class="bx bx-chevron-right"></i></a>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- End About Section -->


    <!-- ======= Contact Section ======= -->

    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-in" data-aos-delay="100">
         
          <p>Entre em contato para tirar dúvidas ou reservar uma de nossas salas. Estamos à disposição para ajudar você a encontrar o espaço ideal.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Localização</h3>
              <p>Rua das Conferências, 123, Sala 400, Sua Cidade, País</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>contato@suacompanhia.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Telefone</h3>
              <p>+55 (11) 1234-5678</p>
            </div>
          </div>
        </div>



      </div>
    </section>
    
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
              <h3>Equilibra Mente</h3>
              <p class="pb-3"><em>Oferecendo salas para locação, espaços para eventos e muito mais.</em></p>
              <p>
                Rua das Conferências, 123, Sala 400<br>
                Sua Cidade, País<br><br>
                <strong>Telefone:</strong> +55 (11) 1234-5678<br>
                <strong>Email:</strong> contato@suacompanhia.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="150">
            <h4>Links Úteis</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Salas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contato</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="250">
            <h4>Nossos Serviços</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Aluguel de Salas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Espaços para Eventos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Salas de Reunião</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter" data-aos="fade-up" data-aos-delay="350">
            <h4>Inscreva-se na nossa Newsletter</h4>
            <p>Fique por dentro das nossas ofertas e disponibilidade de salas.</p>
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
  <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('assets') }}/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/counterup/counterup.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/venobox/venobox.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{ asset('assets') }}/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets') }}/js/main.js"></script>

</body>

</html>