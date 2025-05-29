@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del País</h1>
    <h2>Nombre: {{ $pais->nombre }}</h2>
    <h2>Clave: {{ $pais->clave }}</h2>
    <h2>Status: {{ $pais->status }}</h2>
    <h2>ID: {{ $pais->id }}</h2>
    <br />
    <a href="{{ route('paises.index') }}" class="btn btn-secondary">Regresar a los Países</a>
</div>
@endsection