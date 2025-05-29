@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Detalle de Venta</h1>
    <h2>Venta: {{ $detalle_venta->id_venta }}</h2>
    <h2>Refacción: {{ $detalle_venta->id_producto }}</h2>
    <h2>Cantidad: {{ $detalle_venta->cantidad }}</h2>
    <h2>Precio individual: {{ $detalle_venta->precio_individual }}</h2>
    <h2>Subtotal: {{ $detalle_venta->subtotal }}</h2>
    <h2>ID: {{ $detalle_venta->id }}</h2>
    <br />
    <a href="{{ route('venta_detalles.index') }}" class="btn btn-secondary">Regresar a los Detalles de Venta</a>
</div>
@endsection