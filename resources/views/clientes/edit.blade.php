@extends('template.master')

@section('contenido')
<script src="{{ asset('estilo/js/jquery.min.js') }}"></script>
<script>
    function cambiar_combo_estado(id_pais, estado_id_selected = null) {
        $("#estado_id").empty();
        $("#municipio_id").empty();
        $('#estado_id').append('<option value="">Seleccionar estado</option>');
        $('#municipio_id').append('<option value="">Seleccionar municipio</option>');
        if(id_pais == 0) return;
        
        $.ajax({
            type: 'GET',
            url: "{{ url('/combo_estado') }}/" + id_pais,
            dataType: 'json',
            success: function(data) {
                data.forEach(function(estado) {
                    var selected = (estado_id_selected == estado.id) ? 'selected' : '';
                    $('#estado_id').append('<option value="' + estado.id + '" ' + selected + '>' + estado.nombre + '</option>');
                });
                // Si hay un estado seleccionado, cargar sus municipios
                if(estado_id_selected) {
                    cambiar_combo_municipio(estado_id_selected, {{ $cliente->municipio_id }});
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar estados:', error);
                alert('Error al cargar los estados. Por favor, intente nuevamente.');
            }
        });
    }

    function cambiar_combo_municipio(id_estado, municipio_id_selected = null) {
        $("#municipio_id").empty();
        $('#municipio_id').append('<option value="">Seleccionar municipio</option>');
        if(id_estado == 0) return;
        
        $.ajax({
            type: 'GET',
            url: "{{ url('/combo_municipio') }}/" + id_estado,
            dataType: 'json',
            success: function(data) {
                data.forEach(function(municipio) {
                    var selected = (municipio_id_selected == municipio.id) ? 'selected' : '';
                    $('#municipio_id').append('<option value="' + municipio.id + '" ' + selected + '>' + municipio.nombre + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar municipios:', error);
                alert('Error al cargar los municipios. Por favor, intente nuevamente.');
            }
        });
    }

    // Cargar estados y municipios al iniciar la página
    $(document).ready(function() {
        var pais_id_actual = "{{ $cliente->municipio->estado->pais_id }}";
        var estado_id_actual = "{{ $cliente->municipio->estado_id }}";
        if(pais_id_actual > 0) {
            cambiar_combo_estado(pais_id_actual, estado_id_actual);
        }
    });
</script>

<div class="container">
    <h1>Editar Cliente</h1>
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre del cliente</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" required>
        <br><br>

        <label for="pais_id">País</label>
        <select name="pais_id" id="pais_id" onchange="cambiar_combo_estado(this.value)" required>
            <option value="">Seleccionar país</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}" {{ $cliente->municipio->estado->pais_id == $pais->id ? 'selected' : '' }}>
                    {{ $pais->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="estado_id">Estado</label>
        <select name="estado_id" id="estado_id" onchange="cambiar_combo_municipio(this.value)" required>
            <option value="">Seleccionar estado</option>
        </select>
        <br><br>

        <label for="municipio_id">Municipio</label>
        <select name="municipio_id" id="municipio_id" required>
            <option value="">Seleccionar municipio</option>
        </select>
        <br><br>

        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $cliente->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $cliente->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Cliente</button>
    </form>
    <br>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection