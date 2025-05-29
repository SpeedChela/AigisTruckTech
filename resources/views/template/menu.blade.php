          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
              <span>
                Aigis Truck Tech
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="service.html">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html"> About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> <i class="fa fa-user" aria-hidden="true"></i> Login</a>
                </li>
                <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </form>
              </ul>
            </div>

              <ul class="nav menu">
                  <li><a href="{{ url('/') }}">Inicio<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('paises') }}">Países<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('estados') }}">Estados<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('municipios') }}">Municipios<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('clientes') }}">Clientes<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('proveedores') }}">Proveedores<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('refacciones') }}">Refacciones<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('compras') }}">Compras<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('compra_detalles') }}">Compras Detalles<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('ventas') }}">Ventas<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('venta_detalles') }}">Ventas Detalles<i class="icofont-rounded-down"></i></a></li>
                  <li><a href="{{ url('usuarios') }}">Usuarios<i class="icofont-rounded-down"></i></a></li>
                  
              </ul>
          </nav>