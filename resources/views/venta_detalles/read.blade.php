@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Detalle de Venta</h1>
    <h2>Venta: {{ $venta_detalle->id_venta }}</h2>
    <h2>Producto: {{ $venta_detalle->id_producto }}</h2>
    <h2>Cantidad: {{ $venta_detalle->cantidad }}</h2>
    <h2>Precio: {{ $venta_detalle->precio_individual }}</h2>
    <h2>Subtotal: {{ $venta_detalle->subtotal }}</h2>
    <h2>ID: {{ $venta_detalle->id }}</h2>
    <br />
    <a href="{{ route('venta_detalles.index') }}" class="btn btn-secondary">Regresar a los Detalles de Venta</a>
</div>
@endsection