@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Empresa</h1>
    <form action="{{ route('empresas.store') }}" method="POST">
        @csrf
        <label for="id_usuario_up">Usuario</label>
        <select name="id_usuario_up" id="id_usuario_up" required>
            <option value="">Seleccionar usuario</option>
            @foreach($usuarios as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" placeholder="Ingresa dirección" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Ingresa teléfono" required>
        <br><br>
        <label for="correo">Correo</label>
        <input type="email" name="correo" id="correo" placeholder="Ingresa correo" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar Empresa</button>
    </form>
</div>
@endsection