<nav class="navbar navbar-expand-lg custom_nav-container">
    <a class="navbar-brand" href="{{ url('/') }}">
        <span>Aigis Truck Tech</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Inicio</a>
            </li>

            <!-- Dropdown Ubicaciones -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="ubicacionesDropdown" role="button" 
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ubicaciones
                </a>
                <div class="dropdown-menu" aria-labelledby="ubicacionesDropdown">
                    <a class="dropdown-item" href="{{ url('paises') }}">Países</a>
                    <a class="dropdown-item" href="{{ url('estados') }}">Estados</a>
                    <a class="dropdown-item" href="{{ url('municipios') }}">Municipios</a>
                </div>
            </li>

            <!-- Dropdown Personas -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="personasDropdown" role="button" 
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Personas
                </a>
                <div class="dropdown-menu" aria-labelledby="personasDropdown">
                    <a class="dropdown-item" href="{{ url('clientes') }}">Clientes</a>
                    <a class="dropdown-item" href="{{ url('proveedores') }}">Proveedores</a>
                    <a class="dropdown-item" href="{{ url('usuarios') }}">Usuarios</a>
                </div>
            </li>

            <!-- Dropdown Inventario -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="inventarioDropdown" role="button" 
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Inventario
                </a>
                <div class="dropdown-menu" aria-labelledby="inventarioDropdown">
                    <a class="dropdown-item" href="{{ url('refacciones') }}">Refacciones</a>
                </div>
            </li>

            <!-- Dropdown Compras -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="comprasDropdown" role="button" 
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Compras
                </a>
                <div class="dropdown-menu" aria-labelledby="comprasDropdown">
                    <a class="dropdown-item" href="{{ url('compras') }}">Compras</a>
                    <a class="dropdown-item" href="{{ url('compra_detalles') }}">Detalles de Compras</a>
                </div>
            </li>

            <!-- Dropdown Ventas -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="ventasDropdown" role="button" 
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ventas
                </a>
                <div class="dropdown-menu" aria-labelledby="ventasDropdown">
                    <a class="dropdown-item" href="{{ url('ventas') }}">Ventas</a>
                    <a class="dropdown-item" href="{{ url('venta_detalles') }}">Detalles de Ventas</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<style>
.navbar-nav {
    flex-wrap: wrap;
}

.nav-item {
    margin: 0 5px;
}

.nav-link {
    padding: 8px 15px !important;
    font-size: 0.9rem;
    white-space: nowrap;
}

.dropdown-menu {
    min-width: 200px;
}

.dropdown-item {
    padding: 8px 20px;
    font-size: 0.9rem;
}

@media (max-width: 991px) {
    .navbar-nav {
        padding: 10px;
    }
    
    .nav-item {
        width: 100%;
        margin: 2px 0;
    }
    
    .dropdown-menu {
        border: none;
        padding-left: 20px;
    }
}
</style>