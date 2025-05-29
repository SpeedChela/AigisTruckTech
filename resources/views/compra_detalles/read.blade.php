@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Detalle de Compra</h1>
    <h2>Compra: {{ $compra_detalles->id_compra }}</h2>
    <h2>Producto: {{ $compra_detalles->id_producto }}</h2>
    <h2>Cantidad: {{ $compra_detalles->cantidad }}</h2>
    <h2>Precio: {{ $compra_detalles->precio_individual }}</h2>
    <h2>Subtotal: {{ $compra_detalles->subtotal }}</h2>
    <h2>ID: {{ $compra_detalles->id }}</h2>
    <br />
    <a href="{{ route('venta_detalles.index') }}" class="btn btn-secondary">Regresar a los Detalles de Compra</a>
</div>
@endsection