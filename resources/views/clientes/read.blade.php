@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Cliente</h1>
    <h2>Nombre: {{ $cliente->nombre }}</h2>
    <h2>Teléfono: {{ $cliente->telefono }}</h2>
    <h2>Email: {{ $cliente->email }}</h2>
    <h2>Municipio: {{ $cliente->municipio_id }}</h2>
    <h2>Status: {{ $cliente->status }}</h2>
    <h2>ID: {{ $cliente->id }}</h2>
    <br />
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar a los Clientes</a>
</div>
@endsection