@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar País</h1>
    <form action="{{ route('paises.update', $pais->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre del país</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $pais->nombre) }}" required>
        <br><br>
        <label for="clave">Clave del país</label>
        <input type="text" name="clave" id="clave" value="{{ old('clave', $pais->clave) }}" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $pais->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $pais->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar País</button>
    </form>
    <br>
    <a href="{{ route('paises.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection