@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Detalle de Venta</h1>
    <form action="{{ route('venta_detalles.update', $venta_detalle->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_venta">Venta</label>
        <select name="id_venta" id="id_venta" required>
            <option value="">Seleccionar venta</option>
            @foreach($ventas as $id => $nombre)
                <option value="{{ $id }}" @if(old('id_venta', $venta_detalle->id_venta) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="id_producto">Producto</label>
        <select name="id_producto" id="id_producto" required>
            <option value="">Seleccionar producto</option>
            @foreach($refacciones as $id => $nombre)
                <option value="{{ $id }}" @if(old('id_producto', $venta_detalle->id_producto) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $venta_detalle->cantidad) }}" required>
        <br><br>
        <label for="precio_individual">Precio individual</label>
        <input type="number" name="precio_individual" id="precio_individual" value="{{ old('precio_individual', $venta_detalle->precio_individual) }}" step="0.01" required>
        <br><br>
        <label for="subtotal">Subtotal</label>
        <input type="number" name="subtotal" id="subtotal" value="{{ old('subtotal', $venta_detalle->subtotal) }}" step="0.01" required>
        <br><br>
        <button type="submit">Actualizar Detalle</button>
    </form>
    <br>
    <a href="{{ route('venta_detalles.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection