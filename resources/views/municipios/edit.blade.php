@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Municipio</h1>
    <form action="{{ route('municipios.update', $municipio->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="estado_id">Estado</label>
        <select name="estado_id" id="estado_id" required>
            <option value="">Seleccionar estado</option>
            @foreach($estados as $id => $nombre)
                <option value="{{ $id }}" @if(old('estado_id', $municipio->estado_id) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="nombre">Nombre del municipio</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $municipio->nombre) }}" required>
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