@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Estado</h1>
    <form action="{{ route('estados.update', $estado->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre del estado</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $estado->nombre) }}" required>
        <br><br>
        <label for="clave">Clave del estado</label>
        <input type="text" name="clave" id="clave" value="{{ old('clave', $estado->clave) }}" required>
        <br><br>
        <label for="pais_id">País</label>
        <select name="pais_id" id="pais_id" required>
            <option value="">Seleccionar ...</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}" @if(old('pais_id', $estado->pais_id) == $pais->id) selected @endif>{{ $pais->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $estado->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $estado->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Estado</button>
    </form>
    <br>
    <a href="{{ route('estados.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection