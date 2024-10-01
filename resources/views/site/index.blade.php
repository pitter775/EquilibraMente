@if (Auth::check())
    @if (Auth::user()->tipo_usuario === 'admin')
        <script>window.location = "/admin";</script>
    @else
        <script>window.location = "/cliente";</script>
    @endif
@else


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!-- <meta content="width=device-width, initial-scale=1.0" name="viewport"> -->
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <title>Colégio Carlos Drummond de Andrade</title>



    <!-- Palavras chave -->
    <meta name="keywords" content="Educação, Futuro" />
    

<!-- Descrição do site -->

    <meta name="description" content="Qualquer esforço pela educação é um sonho de sociedade mais justa."/>
    <meta name="theme-color" content="#66619c">
    <meta name="author" content="pitter775@gmail.com">

    <meta property="og:site_name" content="Colégio Carlos Drummond de Andrade">
    <meta property="og:title" content="Instituto Colégio Carlos Drummond de Andrade">
    <meta property="og:description" content="Qualquer esforço pela educação é um sonho de sociedade mais justa."/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="pt_BR"/>    
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://educacaofuturo.org.br/carlosdrummondandrade">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image" content="https://educacaofuturo.org.br/app-assets/images/escola-drummond.jpg" />
    
  <!-- Favicons -->
  <link href="{{ asset('paper') }}/assets/img/icon_logo.png" rel="icon">
  <link href="{{ asset('paper') }}/assets/img/icon_logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Nunito:ital,wght@0,300;0,500;1,200;1,900&family=Quicksand:wght@300&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('paper') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('paper') }}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{ asset('paper') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('paper') }}/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="{{ asset('paper') }}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ asset('paper') }}/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('paper') }}/assets/css/style.css" rel="stylesheet">

</head>

<body>


  <style>
    a.linkpub{ color: #777; font-family: "Open Sans", sans-serif !important; font-size: 13px; margin-top: -10px}
    a.linkpub:hover{ color: #fff;}
    .icon-box2{ padding: 10px !important}
    h3 {   font-family: "Nunito"; font-weight: 500;}
    #hero {
        width: 100%;
        height: 100vh;
        background: url('/paper/assets/img/bg_home3.jpg') top center !important;
        background-size: cover;
        position: relative;
        margin-bottom: -90px;
        }
  </style>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><img src="{{ asset('paper') }}/img/logo_edu.png" alt="" class="img-fluid" style="margin-right: 20px;"><a href="index.html"></a> </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
      </div>
 
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#hero">Home</a></li>
          <li><a href="#publicacao">Publicações</a></li>
          {{-- <li><a href="#contact">Contato</a></li> --}}
          <li><a href="/home" title="Entrar no sistema" style="padding: 15px 15px" ><i class=" icofont-gnome icofont-2x"></i></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->



  <!-- ======= Hero Section ======= -->
  <section id="hero" >
    <div class="hero-container" data-aos="fade-up">
      <div style="padding: 0 50px;">

        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>


        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      <!-- <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a> -->
    </div>
  </section><!-- End Hero -->

  <main id="main">


    
    <!-- ======= Publicações Section ======= -->
    <section id="publicacao" class="services">
      <div class="container">
        <div class="section-title" data-aos="fade-in" data-aos-delay="100">
          <h2>Publicações</h2>
        </div>

        <div class="row" data-aos="fade-in">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="publicacao-flters">
              <li data-filter="*" class="filter-active">Todas as pulicações</li>
              <li data-filter=".filter-Informe">Informes</li>
              <li data-filter=".filter-Evento">Evento</li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4">            
            <div data-aos="fade-up" data-aos-delay="50">
            <img src="{{ asset('paper') }}/assets/img/lgo-g.png" alt="" class="imgfooter" style="width: 200px; display: inline;">
              <br>
    
            </div>
          </div>

          <div class="col-md-4 footer-links" data-aos="fade-up" data-aos-delay="150">
            <h4>Colégio Carlos Drummond de Andrade</h4>
            <p>11 4257-2198<br>
              secretaria@educacaofuturo.org.br<br>
              R: Duque de Caixias - 241<br>
              Centro - Barueri - SP</p>
          </div>

          <div class="col-md-4 footer-links" data-aos="fade-up" data-aos-delay="250">
            <img src="{{ asset('paper') }}/assets/img/logo-pmsp.png" alt="" style="display: inline; width: 80px">
            <img src="{{ asset('paper') }}/assets/img/capa_2_1.gif" alt="" style="display: inline; width: 80px"><br><br>
            <img src="{{ asset('paper') }}/assets/img/objetivo.png" alt="" style="display: inline;width: 180px">
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('paper') }}/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/counterup/counterup.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/venobox/venobox.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{ asset('paper') }}/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('paper') }}/assets/js/main.js">

  </script>

  <script>
    let prot = location.href;
    position = prot.search("127");
    console.log(position);
    if(position !== 7){
      if (location.protocol !== 'https:') {
        location.replace(`https:${location.href.substring(location.protocol.length)}`);
      }
    }    
  </script>

</body>

</html>
@endif