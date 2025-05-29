@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Municipio</h1>
    <form action="{{ route('municipios.store') }}" method="POST">
        @csrf
        <label for="estado_id">Estado</label>
        <select name="estado_id" id="estado_id" required>
            <option value="">Seleccionar estado</option>
            @foreach($estados as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="nombre">Nombre del municipio</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del municipio" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar Municipio</button>
    </form>
</div>
@endsection