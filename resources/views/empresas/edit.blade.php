@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Empresa</h1>
    <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_usuario_up">Usuario</label>
        <select name="id_usuario_up" id="id_usuario_up" required>
            <option value="">Seleccionar usuario</option>
            @foreach($usuarios as $id => $nombre)
                <option value="{{ $id }}" @if(old('id_usuario_up', $empresa->id_usuario_up) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $empresa->direccion) }}" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $empresa->telefono) }}" required>
        <br><br>
        <label for="correo">Correo</label>
        <input type="email" name="correo" id="correo" value="{{ old('correo', $empresa->correo) }}" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $empresa->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $empresa->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Empresa</button>
    </form>
    <br>
    <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection