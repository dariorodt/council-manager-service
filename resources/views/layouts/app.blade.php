<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Council Manager')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        <nav class="bg-dark" style="width: 250px; min-height: 100vh;">
            <div class="p-3">
                <h5 class="text-white">Council Manager</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'bg-primary' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-house me-2"></i>Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-briefcase me-2"></i>Ejecutiva
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-calculator me-2"></i>Administrativa Financiera
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-shield-check me-2"></i>Contraloría Social
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#configMenu" role="button" aria-expanded="{{ request()->routeIs('members.*') ? 'true' : 'false' }}">
                        <span><i class="bi bi-gear me-2"></i>Configuración</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('members.*') ? 'show' : '' }}" id="configMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('members.*') ? 'bg-primary' : '' }}" href="{{ route('members.index') }}">
                                    <i class="bi bi-people me-2"></i>Miembros
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        
        <div class="flex-grow-1">
            <nav class="navbar navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> User
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <nav class="bg-light px-3 py-2">
                <ol class="breadcrumb mb-0">
                    @yield('breadcrumb')
                </ol>
            </nav>
            
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>