@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Detalle de Venta</h1>
    <form action="{{ route('venta_detalles.update', $detalle_venta->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_venta">Venta</label>
        <select name="id_venta" id="id_venta" required>
            <option value="">Seleccionar venta</option>
            @foreach($ventas as $venta)
                <option value="{{ $venta->id }}" @if(old('id_venta', $detalle_venta->id_venta) == $venta->id) selected @endif>
                    {{ $venta->id }}
                </option>
            @endforeach
        </select>
        <br><br>
        <label for="id_producto">Refacción</label>
        <select name="id_producto" id="id_producto" required>
            <option value="">Seleccionar refacción</option>
            @foreach($refacciones as $refaccion)
                <option value="{{ $refaccion->id }}" @if(old('id_producto', $detalle_venta->id_producto) == $refaccion->id) selected @endif>
                    {{ $refaccion->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $detalle_venta->cantidad) }}" required>
        <br><br>
        <label for="precio_individual">Precio individual</label>
        <input type="number" step="0.01" name="precio_individual" id="precio_individual" value="{{ old('precio_individual', $detalle_venta->precio_individual) }}" required>
        <br><br>
        <label for="subtotal">Subtotal</label>
        <input type="number" step="0.01" name="subtotal" id="subtotal" value="{{ old('subtotal', $detalle_venta->subtotal) }}" required>
        <br><br>
        <button type="submit">Actualizar Detalle de Venta</button>
    </form>
    <br>
    <a href="{{ route('venta_detalles.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection