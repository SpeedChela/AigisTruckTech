@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Detalle de Compra</h1>
    <form action="{{ route('compra_detalles.store') }}" method="POST">
        @csrf
        <label for="id_compra">Compra</label>
        <select name="id_compra" id="id_compra" required>
            <option value="">Seleccionar compra</option>
            @foreach($compras as $compra)
                <option value="{{ $compra->id }}">{{ $compra->id }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="id_producto">Producto</label>
        <select name="id_producto" id="id_producto" required>
            <option value="">Seleccionar refacción</option>
            @foreach($refacciones as $refaccion)
                <option value="{{ $refaccion->id }}">{{ $refaccion->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" placeholder="Ingresa cantidad" required>
        <br><br>
        <label for="precio_individual">Precio individual</label>
        <input type="number" name="precio_individual" id="precio_individual" placeholder="Ingresa precio" step="0.01" required>
        <br><br>
        <label for="subtotal">Subtotal</label>
        <input type="number" name="subtotal" id="subtotal" placeholder="Ingresa subtotal" step="0.01" required>
        <br><br>
        <button type="submit">Guardar Detalle</button>
        <br>
        <a href="{{ route('compra_detalles.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection