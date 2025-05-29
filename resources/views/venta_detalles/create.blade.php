@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Detalle de Venta</h1>
    <form action="{{ route('venta_detalles.store') }}" method="POST">
        @csrf
        <label for="id_venta">Venta</label>
        <select name="id_venta" id="id_venta" required>
            <option value="">Seleccionar venta</option>
            @foreach($ventas as $venta)
                <option value="{{ $venta->id }}">{{ $venta->id }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="id_producto">Refacción</label>
        <select name="id_producto" id="id_producto" required>
            <option value="">Seleccionar refacción</option>
            @foreach($refacciones as $refaccion)
                <option value="{{ $refaccion->id }}">{{ $refaccion->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <br><br>
        <label for="precio_individual">Precio individual</label>
        <input type="number" step="0.01" name="precio_individual" id="precio_individual" required>
        <br><br>
        <label for="subtotal">Subtotal</label>
        <input type="number" step="0.01" name="subtotal" id="subtotal" required>
        <br><br>
        <button type="submit">Guardar Detalle de Venta</button>
    </form>
</div>
@endsection