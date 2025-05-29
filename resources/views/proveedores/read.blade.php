@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Proveedor</h1>
    <h2>Nombre: {{ $proveedor->nombre }}</h2>
    <h2>Teléfono: {{ $proveedor->telefono }}</h2>
    <h2>Email: {{ $proveedor->email }}</h2>
    <h2>Municipio: {{ $proveedor->municipio_id }}</h2>
    <h2>Status: {{ $proveedor->status }}</h2>
    <h2>ID: {{ $proveedor->id }}</h2>
    <br />
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Regresar a los Proveedores</a>
</div>
@endsection