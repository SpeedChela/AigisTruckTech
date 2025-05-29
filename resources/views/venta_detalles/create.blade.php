@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Detalle de Venta</h1>
    <form action="{{ route('venta_detalles.store') }}" method="POST">
        @csrf
        <label for="id_venta">Venta</label>
        <select name="id_venta" id="id_venta" required>
            <option value="">Seleccionar venta</option>
            @foreach($ventas as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="id_producto">Producto</label>
        <select name="id_producto" id="id_producto" required>
            <option value="">Seleccionar producto</option>
            @foreach($refacciones as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
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
    </form>
</div>
@endsection