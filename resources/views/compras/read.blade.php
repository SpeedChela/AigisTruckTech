@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle de la Compra</h1>
    <h2>Proveedor: {{ $compra->id_proveedor }}</h2>
    <h2>Usuario: {{ $compra->id_usuario }}</h2>
    <h2>Fecha: {{ $compra->fecha_compra }}</h2>
    <h2>Total: {{ $compra->total }}</h2>
    <h2>Status: {{ $compra->status }}</h2>
    <h2>ID: {{ $compra->id }}</h2>
    <br />
    <a href="{{ route('compras.index') }}" class="btn btn-secondary">Regresar a las Compras</a>
</div>
@endsection