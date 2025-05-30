@extends('template.master')

@section('contenido')
<script src="{{ asset('estilo/js/jquery.min.js') }}"></script>
<script>
    function cambiar_combo_estado(id_pais) {
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
                    $('#estado_id').append('<option value="' + estado.id + '">' + estado.nombre + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar estados:', error);
                alert('Error al cargar los estados. Por favor, intente nuevamente.');
            }
        });
    }

    function cambiar_combo_municipio(id_estado) {
        $("#municipio_id").empty();
        $('#municipio_id').append('<option value="">Seleccionar municipio</option>');
        if(id_estado == 0) return;
        
        $.ajax({
            type: 'GET',
            url: "{{ url('/combo_municipio') }}/" + id_estado,
            dataType: 'json',
            success: function(data) {
                data.forEach(function(municipio) {
                    $('#municipio_id').append('<option value="' + municipio.id + '">' + municipio.nombre + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar municipios:', error);
                alert('Error al cargar los municipios. Por favor, intente nuevamente.');
            }
        });
    }
</script>

<div class="container">
    <h1>Crear Cliente</h1>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="1">
        
        <label for="nombre">Nombre del cliente</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del cliente" required>
        <br><br>
        
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Ingresa teléfono" required>
        <br><br>
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Ingresa email" required>
        <br><br>

        <label for="pais_id">País</label>
        <select name="pais_id" id="pais_id" onchange="cambiar_combo_estado(this.value)" required>
            <option value="">Seleccionar país</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
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
        
        <button type="submit">Guardar Cliente</button>
        <br><br>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection