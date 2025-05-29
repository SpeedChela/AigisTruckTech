@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Cliente</h1>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre del cliente</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del cliente" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Ingresa teléfono" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Ingresa email" required>
        <br><br>
        <label for="municipio_id">Municipio</label>
        <select name="municipio_id" id="municipio_id" required>
            <option value="">Seleccionar municipio</option>
            @foreach($municipios as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar Cliente</button>
    </form>
</div>
@endsection