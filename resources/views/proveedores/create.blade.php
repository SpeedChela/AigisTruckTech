@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Proveedor</h1>
    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre del proveedor</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del proveedor" required>
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
        @foreach($municipios as $municipio)
            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
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
        <button type="submit">Guardar Proveedor</button>
    </form>
</div>
@endsection