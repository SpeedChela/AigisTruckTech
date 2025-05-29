@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>
        <br><br>
        <label for="rol">Rol</label>
        <select name="rol" id="rol" required>
            <option value="">Seleccionar rol</option>
            <option value="admin" @if(old('rol', $usuario->rol) == 'admin') selected @endif>Admin</option>
            <option value="vendedor" @if(old('rol', $usuario->rol) == 'vendedor') selected @endif>Vendedor</option>
            <option value="cliente" @if(old('rol', $usuario->rol) == 'cliente') selected @endif>Cliente</option>
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $usuario->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $usuario->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <label>Seleccionar país</label>
        <select name="id_pais" id="id_pais" onchange="cambiar_combo_estado(this.value);" required>
            <option value="0">Seleccionar...</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}" @if(old('id_pais', $usuario->id_pais) == $pais->id) selected @endif>
                    {{ $pais->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>
        <label>Seleccionar estado</label>
        <select name="id_estado" id="id_estado" onchange="cambiar_combo_municipios(this.value);" required>
            <option value="0">Seleccionar...</option>
        </select>
        <br><br>
        <label>Seleccionar municipio</label>
        <select name="municipio_id" id="municipio_id" required>
            <option value="0">Seleccionar...</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Usuario</button>
    </form>
    <br>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Regresar</a>
</div>

<script src="{{ asset('estilo/js/jquery.min.js') }}"></script>
<script>
    // Llenar los combos al cargar la página
    $(document).ready(function() {
        // Selecciona el país actual
        var idPais = "{{ old('id_pais', $usuario->id_pais) }}";
        var idEstado = "{{ old('id_estado', $usuario->id_estado) }}";
        var idMunicipio = "{{ old('municipio_id', $usuario->municipio_id) }}";

        if(idPais > 0){
            cambiar_combo_estado(idPais, idEstado, idMunicipio);
        }
    });

    function cambiar_combo_estado(id_pais, id_estado_seleccionado = null, id_municipio_seleccionado = null){
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
                    var selected = (id_estado_seleccionado == estado.id) ? 'selected' : '';
                    $('#id_estado').append('<option value="' + estado.id + '" '+selected+'>' + estado.nombre + '</option>');
                });
                // Si hay estado seleccionado, cargar municipios
                if(id_estado_seleccionado){
                    cambiar_combo_municipios(id_estado_seleccionado, id_municipio_seleccionado);
                }
            }
        });
    }

    function cambiar_combo_municipios(id_estado, id_municipio_seleccionado = null){
        $("#municipio_id").empty();
        $('#municipio_id').append('<option value="0">Seleccionar...</option>');
        if(id_estado == 0) return;
        var ruta = "/combo_municipio/" + id_estado;
        $.ajax({
            type: 'GET',
            url: ruta,
            success: function(data){
                data.forEach(function(municipio) {
                    var selected = (id_municipio_seleccionado == municipio.id) ? 'selected' : '';
                    $('#municipio_id').append('<option value="' + municipio.id + '" '+selected+'>' + municipio.nombre + '</option>');
                });
            }
        });
    }
</script>
@endsection