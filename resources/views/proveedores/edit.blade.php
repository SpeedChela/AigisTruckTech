@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Proveedor</h1>
    <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre del proveedor</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required>
        <br><br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $proveedor->telefono) }}" required>
        <br><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $proveedor->email) }}" required>
        <br><br>
        <label for="municipio_id">Municipio</label>
        <select name="municipio_id" id="municipio_id" required>
        <option value="">Seleccionar municipio</option>
        @foreach($municipios as $municipio)
            <option value="{{ $municipio->id }}" @if(old('municipio_id', $proveedor->municipio_id) == $municipio->id) selected @endif>
                {{ $municipio->nombre }}
            </option>
        @endforeach
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $proveedor->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $proveedor->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Proveedor</button>
    </form>
    <br>
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection