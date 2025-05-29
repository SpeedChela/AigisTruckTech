@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Refacción</h1>
    <form action="{{ route('refacciones.update', $refaccion->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_proveedor">Proveedor</label>
        <select name="id_proveedor" id="id_proveedor" required>
            <option value="">Seleccionar proveedor</option>
            @foreach($proveedores as $id => $nombre)
                <option value="{{ $id }}" @if(old('id_proveedor', $refaccion->id_proveedor) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="nombre">Nombre de la refacción</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $refaccion->nombre) }}" required>
        <br><br>
        <label for="marca">Marca</label>
        <input type="text" name="marca" id="marca" value="{{ old('marca', $refaccion->marca) }}" required>
        <br><br>
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" value="{{ old('precio', $refaccion->precio) }}" step="0.01" required>
        <br><br>
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $refaccion->stock) }}" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $refaccion->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $refaccion->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Refacción</button>
    </form>
    <br>
    <a href="{{ route('refacciones.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection