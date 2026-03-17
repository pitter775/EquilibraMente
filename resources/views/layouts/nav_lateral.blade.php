    <!-- BEGIN: Main Menu-->
    <style>
        .menu_lateral { background-color: #FFF !important; background-image: url("{{asset('assets/img/bg-lateral.png')}} " ) !important; 
        background-repeat: no-repeat !important; 
        background-attachment: fixed !important; 
        background-position: bottom left !important;  
        }

        .menu_lateral .main-menu-content {
            padding-bottom: 128px;
        }

        .sidebar-account {
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 16px;
            padding: 14px 12px;
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.68) 0%, rgba(255, 255, 255, 0.44) 100%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 16px 34px rgba(69, 91, 58, 0.16);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .sidebar-account__top {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .sidebar-account__avatar {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .sidebar-account__name {
            color: #42533b;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 2px;
        }

        .sidebar-account__role {
            color: #7b8677;
            font-size: 12px;
            text-transform: capitalize;
            line-height: 1.2;
        }

        .sidebar-account__logout {
            width: 100%;
            justify-content: center;
            border-radius: 12px;
        }

        .sidebar-account__logout-label {
            display: inline;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .menu_lateral .main-menu-content {
            padding-bottom: 94px;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account {
            left: 8px;
            right: 8px;
            bottom: 12px;
            padding: 10px 6px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account__top {
            margin-bottom: 0;
            justify-content: center;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account__avatar {
            width: 34px;
            height: 34px;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account__name,
        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account__role {
            display: none;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account__logout {
            width: 34px;
            min-width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 12px;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account__logout .mr-50 {
            margin-right: 0 !important;
        }

        html body.vertical-layout.vertical-menu-modern.menu-collapsed .sidebar-account__logout-label {
            display: none;
        }

        .sidebar-mobile-toggle {
            position: fixed;
            right: 14px;
            bottom: 14px;
            z-index: 1005;
            width: 46px;
            height: 46px;
            border: 0;
            border-radius: 999px;
            display: none;
            align-items: center;
            justify-content: center;
            background: #4f7e48;
            color: #fff;
            box-shadow: 0 12px 24px rgba(57, 90, 49, 0.22);
        }

        @media (max-width: 991.98px) {
            .sidebar-mobile-toggle {
                display: inline-flex;
            }
        }
    </style>
    <input type="hidden" value="{{Auth::user()->use_perfil}}" name="use_perfilInput" id="use_perfilInput" />
    <button class="sidebar-mobile-toggle menu-toggle" type="button" aria-label="Abrir menu">
        <i data-feather="menu"></i>
    </button>
    <div class="main-menu menu_lateral menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header mb-4" >
                <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="">
                    <span class="brand-logo" style="margin-left: 6px">
                         <img src="/assets/img/logoimg.png" style="height: 25px">
                         {{-- <img src="/assets/img/logofinoescuro.png" style="height: 30px"> --}}
                    </span>
                        <h2 class="brand-text" style="font-size: 18px"><img src="/assets/img/logotexto.png" style="height: 11px"></h2>
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
                
                <li class="{{ $elementActive == 'fechadura' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="/admin/fechadura">
                        <i data-feather='lock'></i><span class="menu-title text-truncate" data-i18n="Chave Eletrônica">Chave Eletrônica</span>
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

                 <li class="{{ $elementActive == 'analitico' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('/admin/analitico') }}">
                        <i data-feather='bar-chart-2'></i><span class="menu-title text-truncate" data-i18n="Site">Analitico de Acessos</span>
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
        <div class="sidebar-account">
            <div class="sidebar-account__top">
                @if(Auth::user()->photo == null)
                    <img src="{{ asset('app-assets/images/avatars/avatar.png') }}" alt="avatar" class="sidebar-account__avatar">
                @else
                    <img src="{{ Auth::user()->photo }}" alt="avatar" class="sidebar-account__avatar">
                @endif
                <div>
                    <div class="sidebar-account__name">{{ Auth::user()->name }}</div>
                    <div class="sidebar-account__role">{{ Auth::user()->tipo_usuario }}</div>
                </div>
            </div>
            <a class="btn btn-outline-secondary btn-sm d-flex align-items-center sidebar-account__logout" href="{{ route('logout') }}" title="Sair" aria-label="Sair">
                <i class="mr-50" data-feather="power"></i>
                <span class="sidebar-account__logout-label">Sair</span>
            </a>
        </div>
    </div>

    <script>

    </script>
    <!-- END: Main Menu-->
