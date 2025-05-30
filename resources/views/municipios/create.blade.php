@extends('template.master')

@section('contenido')
<script src="{{ asset('estilo/js/jquery.min.js') }}"></script>
<script>
    function cambiar_combo_estado(id_pais) {
        $("#estado_id").empty();
        $('#estado_id').append('<option value="">Seleccionar estado</option>');
        if(id_pais == 0) return;
        
        $.ajax({
            type: 'GET',
            url: "{{ url('/combo_estado') }}/" + id_pais,
            dataType: 'json',
            success: function(data) {
                data.forEach(function(estado) {
                    $('#estado_id').append('<option value="' + estado.id + '">' + estado.nombre + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar estados:', error);
                alert('Error al cargar los estados. Por favor, intente nuevamente.');
            }
        });
    }
</script>

<div class="container">
    <h1>Crear Municipio</h1>
    <form action="{{ route('municipios.store') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="1">
        
        <label for="pais_id">País</label>
        <select name="pais_id" id="pais_id" onchange="cambiar_combo_estado(this.value)" required>
            <option value="">Seleccionar país</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
            @endforeach
        </select>
        <br><br>

        <label for="estado_id">Estado</label>
        <select name="estado_id" id="estado_id" required>
            <option value="">Seleccionar estado</option>
        </select>
        <br><br>

        <label for="nombre">Nombre del municipio</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del municipio" required>
        <br><br>

        <label for="clave">Clave del municipio</label>
        <input type="text" name="clave" id="clave" placeholder="Ingresa clave del municipio" required>
        <br><br>

        <button type="submit">Guardar Municipio</button>
        <br>
        <a href="{{ route('municipios.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection