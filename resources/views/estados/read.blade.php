@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Estado</h1>
    <h2>Nombre: {{ $estado->nombre }}</h2>
    <h2>País ID: {{ $estado->pais_id }}</h2>
    <h2>Status: {{ $estado->status }}</h2>
    <h2>ID: {{ $estado->id }}</h2>
    <br />
    <a href="{{ route('estados.index') }}" class="btn btn-secondary">Regresar a los Estados</a>
</div>
@endsection