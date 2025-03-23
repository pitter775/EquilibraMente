<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta name="theme-color" content="#556050"> 

  <title>Espaço Equilibra Mente - {{ $sala->nome ?? '' }}</title>
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


  <!-- Template Main CSS File -->
  
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/bordered-layout.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">  
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">
      <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  


  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">

  

  <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/calendars/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">


  <link href="/assets/css/style.css" rel="stylesheet">
  
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-GRG4XXWLH3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-GRG4XXWLH3');
  </script>

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center hero-content">

      <div class="logo mr-auto">
        <a href="/"><img src="/assets/img/logotextopp.png" style="opacity: 0; padding: 13px"> </a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="/#hero" style="color: #556050">Detalhe</a></li>
          <li><a href="/#about"  style="color: #556050">Salas</a></li>
          <li><a href="/#faq"  style="color: #556050">Perguntas</a></li> 
          <li>
              @if(auth()->check())
                  @if(auth()->user()->tipo_usuario === 'admin')
                      <a href="{{ route('admin.dashboard') }}"  style="color: #556050">Gestão</a>
                  @else
                      <a href="{{ route('cliente.reservas') }}"  style="color: #556050">Minhas Reservas</a>
                  @endif
              @else
                  <a href="{{ route('login') }}"  style="color: #556050">Entre</a>
              @endif
          </li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->


    @yield('content')


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info" >
              <img src="/assets/img/logoescuro.png" alt="" class="img-fluid mb-4" style=" width: 70%;"> 
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 footer-links" >
              <h4>Nossos Serviços</h4>
              <ul>
                  <li><i class="bx bx-chevron-right"></i> Atendimento Personalizado</li>
                  <li><i class="bx bx-chevron-right"></i> Aluguel de Salas</li>
                  <li><i class="bx bx-chevron-right"></i> Espaços para Eventos</li>
                  <li><i class="bx bx-chevron-right"></i> Salas de Reunião</li>                  
                  <li><i class="bx bx-chevron-right"></i> Ambientes Equipados</li>
              </ul>
          </div>


          <div class="col-lg-4 col-md-6 footer-newsletter">
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
  <!-- FullCalendar e Dependências -->
  <script src="{{ asset('app-assets/vendors/js/calendar/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/pt.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/locale/pt-br.min.js"></script> --}}
  
  <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>


  <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    
    <script>
      // Aplica a máscara após o carregamento completo do DOM

      
      
      $(document).ready(function() {
            const datatablesLangUrl = "{{ asset('assets/js/datatables-pt-br.json') }}";
            
            $('#endereco_cep').mask('00000-000');
            $('#telefone').mask('(00) 00000-0000');
        

            // Evento para buscar endereço quando o CEP é preenchido
            $(document).on('blur', '#endereco_cep', function () {
                let cep = $(this).val().replace(/\D/g, '');

                if (cep.length === 8) {
                    $.getJSON(`/api/cep/${cep}`, function (data) {
                        if (!("erro" in data)) {
                            $('#endereco_rua').val(data.logradouro);
                            $('#endereco_bairro').val(data.bairro);
                            $('#endereco_cidade').val(data.localidade);
                            $('#endereco_estado').val(data.uf);
                        } else {
                            toastr.error("CEP não encontrado.");
                        }
                    }).fail(function() {
                        toastr.error("Erro ao buscar o endereço. Tente novamente.");
                    });
                } else {
                    toastr.warning("CEP inválido. Insira um CEP com 8 dígitos.");
                }
            });

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
      
    </script> 


    @stack('js_page')

</body>

</html>