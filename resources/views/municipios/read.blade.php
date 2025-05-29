@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Municipio</h1>
    <h2>Nombre: {{ $municipio->nombre }}</h2>
    <h2>Estado ID: {{ $municipio->estado_id }}</h2>
    <h2>Status: {{ $municipio->status }}</h2>
    <h2>ID: {{ $municipio->id }}</h2>
    <br />
    <a href="{{ route('municipios.index') }}" class="btn btn-secondary">Regresar a los Municipios</a>
</div>
@endsection