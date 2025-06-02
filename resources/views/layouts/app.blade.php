<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aigis Truck Tech - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('styles')

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1e3d59 !important;
        }
        .auth-container {
            margin-top: 5%;
        }
        .auth-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .auth-card .card-header {
            background-color: #1e3d59;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }
        .auth-card .card-body {
            padding: 30px;
        }
        .btn-primary {
            background-color: #1e3d59;
            border-color: #1e3d59;
        }
        .btn-primary:hover {
            background-color: #15293d;
            border-color: #15293d;
        }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 350px;
            max-width: 90%;
        }
        .notification .alert {
            margin-bottom: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-left: 4px solid;
        }
        .notification .alert-success {
            border-left-color: #198754;
        }
        .notification .alert-danger {
            border-left-color: #dc3545;
        }
        .notification .alert-warning {
            border-left-color: #ffc107;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                🚛 Aigis Truck Tech
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @guest
                                <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                                </li>
                                <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                </li>
                        @else
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->nombre }}
                                </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <!-- Notificaciones -->
    <div class="notification">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

        <main class="py-4">
            @yield('content')
        </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
    
    <!-- Script para auto-cerrar las notificaciones -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000); // La notificación se cerrará después de 5 segundos
            });
        });
    </script>
</body>
</html>
