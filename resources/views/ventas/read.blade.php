@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle de la Venta</h1>
    <h2>Usuario: {{ $venta->id_usuario }}</h2>
    <h2>Cliente: {{ $venta->id_cliente }}</h2>
    <h2>Fecha: {{ $venta->fecha_venta }}</h2>
    <h2>Total: {{ $venta->total }}</h2>
    <h2>Status: {{ $venta->status }}</h2>
    <h2>ID: {{ $venta->id }}</h2>
    <br />
    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Regresar a las Ventas</a>
</div>
@endsection