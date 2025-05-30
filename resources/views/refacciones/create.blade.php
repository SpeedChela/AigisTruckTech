@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Refacción</h1>
    <form action="{{ route('refacciones.store') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="1">
        <label for="id_proveedor">Proveedor</label>
        <select name="proveedor_id" id="proveedor_id" required>
            <option value="">Seleccionar proveedor</option>
            @foreach($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="nombre">Nombre de la refacción</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre de la refacción" required>
        <br><br>
        <label for="marca">Marca</label>
        <input type="text" name="marca" id="marca" placeholder="Ingresa marca" required>
        <br><br>
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" placeholder="Ingresa precio" step="0.01" required>
        <br><br>
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" placeholder="Ingresa stock" required>
        <br><br>
        <button type="submit">Guardar Refacción</button>
        <br>
        <br>
        <a href="{{ route('refacciones.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection