@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle de la Refacción</h1>
    <h2>Proveedor: {{ $refaccion->id_proveedor }}</h2>
    <h2>Nombre: {{ $refaccion->nombre }}</h2>
    <h2>Marca: {{ $refaccion->marca }}</h2>
    <h2>Precio: {{ $refaccion->precio }}</h2>
    <h2>Stock: {{ $refaccion->stock }}</h2>
    <h2>Status: {{ $refaccion->status }}</h2>
    <h2>ID: {{ $refaccion->id }}</h2>
    <br />
    <a href="{{ route('refacciones.index') }}" class="btn btn-secondary">Regresar a las Refacciones</a>
</div>
@endsection