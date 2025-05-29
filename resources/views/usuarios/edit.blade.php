@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>
        <br><br>
        <label for="rol">Rol</label>
        <select name="rol" id="rol" required>
            <option value="">Seleccionar rol</option>
            <option value="admin" @if(old('rol', $usuario->rol) == 'admin') selected @endif>Admin</option>
            <option value="vendedor" @if(old('rol', $usuario->rol) == 'vendedor') selected @endif>Vendedor</option>
            <option value="cliente" @if(old('rol', $usuario->rol) == 'cliente') selected @endif>Cliente</option>
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $usuario->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $usuario->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Usuario</button>
    </form>
    <br>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection