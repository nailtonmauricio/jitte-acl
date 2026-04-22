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
    @livewireStyles
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-light bg-white shadow-sm">

    <!-- Brand -->
    <a class="navbar-brand ps-3" href="#">Jitte</a>

    <!-- Toggle -->
    <button class="btn btn-link btn-sm me-4" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Right -->
    <ul class="navbar-nav ms-auto align-items-center">

        {{-- Notificações --}}
        <li class="nav-item dropdown me-3">
            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-bell"></i>
                <span class="badge bg-danger badge-counter">3</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li class="dropdown-header">Notificações</li>

                <li>
                    <a class="dropdown-item" href="#">
                        <small class="text-muted">Hoje</small><br>
                        Novo usuário cadastrado
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-center small" href="#">
                        Ver todas
                    </a>
                </li>
            </ul>
        </li>

        {{-- Mensagens --}}
        <li class="nav-item dropdown me-3">
            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-envelope"></i>
                <span class="badge bg-danger badge-counter">5</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li class="dropdown-header">Mensagens</li>

                <li>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="me-2">
                            <img class="rounded-circle" width="40" src="https://via.placeholder.com/40">
                        </div>
                        <div>
                            <div class="small text-muted">João • 2 min</div>
                            Nova mensagem enviada
                        </div>
                    </a>
                </li>

            </ul>
        </li>

        {{-- Usuário --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">

                <span class="me-2 d-none d-lg-inline text-gray-600 small">
                    {{ auth()->user()->name }}
                </span>

                <img class="img-profile rounded-circle"
                     width="35"
                     src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}">
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">

                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fa-solid fa-user-gear me-2"></i> Perfil
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item" href="{{ route('logout.process') }}">
                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sair
                    </a>
                </li>

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

                    {{-- Dashboard --}}
                    @can('home-index')
                        <a @class(['nav-link', 'active'=>isset($menu) && $menu == 'inicio']) href="{{ route('home.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                            Dashboard
                        </a>
                    @endcan

                    {{-- Grupo colapsável --}}
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Usuários
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse {{ isset($menu) && in_array($menu, ['operadores','niveis-acesso']) ? 'show' : '' }}" id="collapseUsers">
                        <nav class="sb-sidenav-menu-nested nav">

                            @can('user-index')
                                <a class="nav-link {{ isset($menu) && $menu == 'operadores' ? 'active' : '' }}" href="{{ route('user.index') }}">
                                    Operadores
                                </a>
                            @endcan

                            @can('role-index')
                                <a class="nav-link {{ isset($menu) && $menu == 'niveis-acesso' ? 'active' : '' }}" href="{{ route('role.index') }}">
                                    Níveis de acesso
                                </a>
                            @endcan

                        </nav>
                    </div>

                    {{-- Logout --}}
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
                <x-alert/>
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
@livewireScripts
</body>
</html>
