@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Estado de Envío</h1>
    <h2>Compra: {{ $estado_envio->id_compra }}</h2>
    <h2>Status: {{ $estado_envio->status }}</h2>
    <h2>ID: {{ $estado_envio->id }}</h2>
    <br />
    <a href="{{ route('estado_envios.index') }}" class="btn btn-secondary">Regresar a los Estados de Envío</a>
</div>
@endsection