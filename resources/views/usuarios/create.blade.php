@extends('template.master')

@section('contenido')

<script src="{{ asset('estilo/js/jquery.min.js') }}"></script>
<script>
    function cambiar_combo_estado(id_pais){
        $("#id_estado").empty();
        $("#municipio_id").empty();
        $('#id_estado').append('<option value="0">Seleccionar...</option>');
        $('#municipio_id').append('<option value="0">Seleccionar...</option>');
        if(id_pais == 0) return;
        var ruta = "/combo_estado/" + id_pais;
        $.ajax({
            type: 'GET',
            url: ruta,
            success: function(data){
                data.forEach(function(estado) {
                    $('#id_estado').append('<option value="' + estado.id + '">' + estado.nombre + '</option>');
                });
            }
        });
    }

    function cambiar_combo_municipios(id_estado){
        $("#municipio_id").empty();
        $('#municipio_id').append('<option value="0">Seleccionar...</option>');
        if(id_estado == 0) return;
        var ruta = "/combo_municipio/" + id_estado;
        $.ajax({
            type: 'GET',
            url: ruta,
            success: function(data){
                data.forEach(function(municipio) {
                    $('#municipio_id').append('<option value="' + municipio.id + '">' + municipio.nombre + '</option>');
                });
            }
        });
    }
</script>
<div class="container">
    <h1>Crear Usuario</h1>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Ingresa email" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Ingresa teléfono" required>
        <br><br>
        <label for="rol">Rol</label>
        <select name="rol" id="rol" required>
            <option value="">Seleccionar rol</option>
            <option value="admin">Admin</option>
            <option value="vendedor">Vendedor</option>
            <option value="cliente">Cliente</option>
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <label>Seleccionar país</label>
        <select name="id_pais" id="id_pais" onchange="cambiar_combo_estado(this.value);">
            <option value="0">Seleccionar...</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label>Seleccionar estado</label>
        <select name="id_estado" id="id_estado" onchange="cambiar_combo_municipios(this.value);">
            <option value="0">Seleccionar...</option>
        </select>
        <br><br>
        <label>Seleccionar municipio</label>
        <select name="municipio_id" id="municipio_id">
            <option value="0">Seleccionar...</option>
        </select>
        <br><br>
        <button type="submit">Guardar Usuario</button>
    </form>
</div>


@endsection