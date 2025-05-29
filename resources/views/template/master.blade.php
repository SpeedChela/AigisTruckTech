@include('template.encabezado')
@include('template.menu')

<div class="container" style="min-height: 70vh;">
    @yield('contenido')
</div>

@include('template.pie')