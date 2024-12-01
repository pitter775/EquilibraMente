    <!-- BEGIN: Main Menu-->
    <style>
        .menu_lateral { background-color: #FFF !important; background-image: url("{{asset('assets/img/bg-lateral.png')}} " ) !important; 
        background-repeat: no-repeat !important; 
        background-attachment: fixed !important; 
        background-position: bottom left !important;  
        }
    </style>
    <input type="hidden" value="{{Auth::user()->use_perfil}}" name="use_perfilInput" id="use_perfilInput" />
    <div class="main-menu menu_lateral menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header mb-4" >
                <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="">
                    <span class="brand-logo" style="margin-left: 6px">
                         <img src="{{ asset('assets') }}/img/logoimg.png" style="height: 25px">
                         {{-- <img src="{{ asset('assets') }}/img/logofinoescuro.png" style="height: 30px"> --}}
                    </span>
                        <h2 class="brand-text" style="font-size: 18px"><img src="{{ asset('assets') }}/img/logotexto.png" style="height: 11px"></h2>
                    </a></li>
                <li class="nav-item nav-toggle" style="margin-top: 3px"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>

        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @if(Auth::user()->tipo_usuario == 'admin')
                <!-- Menu Admin -->
                <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="/admin">
                        <i data-feather='home'></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>
                
                <li class="{{ $elementActive == 'salas' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="/admin/salas">
                        <i data-feather='briefcase'></i><span class="menu-title text-truncate" data-i18n="Gerenciar Salas">Gerenciar Salas</span>
                    </a>
                </li>
                
                <li class="{{ $elementActive == 'reservas' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="/admin/reservas">
                        <i data-feather='calendar'></i><span class="menu-title text-truncate" data-i18n="Reservas">Reservas</span>
                    </a>
                </li>
                
                <li class="{{ $elementActive == 'usuarios' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="/admin/usuarios">
                        <i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Usuários">Usuários</span>
                    </a>
                </li>
                <li class="{{ $elementActive == 'site' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('/') }}" target="_blank">
                        <i data-feather='globe'></i><span class="menu-title text-truncate" data-i18n="Site">Ir para o site</span>
                    </a>
                </li>


            @elseif(Auth::user()->tipo_usuario == 'cliente')
                <!-- Menu Cliente -->
               

                
                    <li class="{{ $elementActive == 'minhas-reservas' ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="/cliente/reservas">
                            <i data-feather='calendar'></i><span class="menu-title text-truncate" data-i18n="Minhas Reservas">Minhas Reservas</span>
                        </a>
                    </li>

                    <li class="{{ $elementActive == 'politica-privacidade' ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('privacidade') }}" target="_blank">
                            <i data-feather='shield'></i><span class="menu-title text-truncate" data-i18n="Privacidade">Políticas de Privacidade</span>
                        </a>
                    </li>

                    <li class="{{ $elementActive == 'salas' ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('site.index') }}#about" target="_blank">
                            <i data-feather='grid'></i><span class="menu-title text-truncate" data-i18n="Salas">Ver Salas</span>
                        </a>
                    </li>


                
            @endif

        </ul>

        </div>
    </div>

    <script>

    </script>
    <!-- END: Main Menu-->