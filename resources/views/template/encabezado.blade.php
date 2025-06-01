<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('estilo/images/fevicon.png') }}" type="">

  <title> Aigis Truck Tech </title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('estilo/css/bootstrap.css') }}" />

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="{{ asset('estilo/css/font-awesome.min.css') }}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('estilo/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('estilo/css/responsive.css') }}" rel="stylesheet" />

  @stack('styles')
</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid ">
          <div class="contact_nav">
            <a href="mailto:contacto@aigistrucktech.com" class="btn btn-link">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Contáctanos por correo
              </span>
            </a>
            @guest
              <a href="{{ route('login') }}" class="btn btn-link">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                  Iniciar Sesión
                </span>
              </a>
            @else
              <a href="{{ route('logout') }}" class="btn btn-link"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>
                  Cerrar Sesión
                </span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            @endguest
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">