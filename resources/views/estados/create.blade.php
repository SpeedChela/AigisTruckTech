@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Estado</h1>
    <form action="{{ route('estados.store') }}" method="POST">
        @csrf
        <label for="pais_id">País</label>
        <select name="pais_id" id="pais_id" required>
            <option value="">Seleccionar país</option>
            @foreach($paises as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="nombre">Nombre del estado</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del estado" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar Estado</button>
    </form>
</div>
@endsection