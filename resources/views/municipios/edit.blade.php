@extends('template.master')

@section('contenido')
<script src="{{ asset('estilo/js/jquery.min.js') }}"></script>
<script>
    function cambiar_combo_estado(id_pais, estado_id_selected = null) {
        $("#estado_id").empty();
        $('#estado_id').append('<option value="">Seleccionar estado</option>');
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
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar estados:', error);
                alert('Error al cargar los estados. Por favor, intente nuevamente.');
            }
        });
    }

    // Cargar estados al iniciar la página
    $(document).ready(function() {
        var estado_id_actual = "{{ old('estado_id', $municipio->estado_id) }}";
        var pais_id_actual = "{{ $municipio->estado->pais_id ?? '' }}";
        if(pais_id_actual > 0) {
            cambiar_combo_estado(pais_id_actual, estado_id_actual);
        }
    });
</script>

<div class="container">
    <h1>Editar Municipio</h1>
    <form action="{{ route('municipios.update', $municipio->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="pais_id">País</label>
        <select name="pais_id" id="pais_id" onchange="cambiar_combo_estado(this.value)" required>
            <option value="">Seleccionar país</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}" {{ ($municipio->estado->pais_id ?? '') == $pais->id ? 'selected' : '' }}>
                    {{ $pais->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>
        <label for="estado_id">Estado</label>
        <select name="estado_id" id="estado_id" required>
            <option value="">Seleccionar estado</option>
        </select>
        <br><br>
        <label for="nombre">Nombre del municipio</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $municipio->nombre) }}" required>
        <br><br>
        <label for="clave">Clave del municipio</label>
        <input type="text" name="clave" id="clave" value="{{ old('clave', $municipio->clave) }}" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $municipio->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $municipio->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Municipio</button>
    </form>
    <br>
    <a href="{{ route('municipios.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection