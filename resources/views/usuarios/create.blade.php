@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Usuario</h1>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Ingresa email" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Ingresa teléfono" required>
        <br><br>
        <label for="rol">Rol</label>
        <select name="rol" id="rol" required>
            <option value="">Seleccionar rol</option>
            <option value="admin">Admin</option>
            <option value="vendedor">Vendedor</option>
            <option value="cliente">Cliente</option>
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar Usuario</button>
    </form>
</div>
@endsection