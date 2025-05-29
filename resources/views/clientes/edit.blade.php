@extends('template.master')

@section('contenido')
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
        <label for="municipio_id">Municipio</label>
        <select name="municipio_id" id="municipio_id" required>
            <option value="">Seleccionar municipio</option>
            @foreach($municipios as $id => $nombre)
                <option value="{{ $id }}" @if(old('municipio_id', $cliente->municipio_id) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
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