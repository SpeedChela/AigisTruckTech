@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Detalle de Compra</h1>
    <h2>Compra: {{ $compra_detalle->id_compra }}</h2>
    <h2>Producto: {{ $compra_detalle->id_producto }}</h2>
    <h2>Cantidad: {{ $compra_detalle->cantidad }}</h2>
    <h2>Precio: {{ $compra_detalle->precio_individual }}</h2>
    <h2>Subtotal: {{ $compra_detalle->subtotal }}</h2>
    <h2>ID: {{ $compra_detalle->id }}</h2>
    <br />
    <a href="{{ route('compra_detalles.index') }}" class="btn btn-secondary">Regresar a los Detalles de Compra</a>
</div>
@endsection