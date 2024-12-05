<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>{{ env('APP_NAME') }}</title>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark bg-gradient">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="#">Jitte</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
               aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear me-2"></i>Perfil</a></li>
                <li>
                    <hr class="dropdown-divider"/>
                </li>
                <li><a class="dropdown-item" href="{{ route('logout.process', ['user']) }}"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Sair</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-five" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    @can('home-index')
                        <a @class(['nav-link', 'active'=>isset($menu) && $menu == 'inicio']) href="{{ route('home.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                            Dashboard
                        </a>
                    @endcan

                    @can('user-index')
                        <a @class(['nav-link', 'active'=>isset($menu) && $menu == 'operadores']) href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users-cog"></i></div>
                            Operadores
                        </a>
                    @endcan

                    @can('role-index')
                        <a @class(['nav-link', 'active' =>isset($menu) && $menu == 'niveis-acesso']) href="{{ route('role.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-network-wired"></i></div>
                            Níveis de acesso
                        </a>
                    @endcan

                    <a class="nav-link" href="{{ route('logout.process') }}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                        Sair
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer p-4">
                <div class="small">Logged in as:
                    <span class="text-capitalize">
                    @if(auth()->check())
                        {{ explode(' ', auth()->user()->name)[0] }}
                    @endif
                    </span>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Jitte {{ date('Y') }}</div>
                    <div>
                        <a href="#">Política de privacidade</a>
                        <a href="#">Termos &amp; Condições</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@stack('scripts')
</body>
</html>
