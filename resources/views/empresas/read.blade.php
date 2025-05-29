@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle de la Empresa</h1>
    <h2>Usuario: {{ $empresa->id_usuario_up }}</h2>
    <h2>Dirección: {{ $empresa->direccion }}</h2>
    <h2>Teléfono: {{ $empresa->telefono }}</h2>
    <h2>Correo: {{ $empresa->correo }}</h2>
    <h2>Status: {{ $empresa->status }}</h2>
    <h2>ID: {{ $empresa->id }}</h2>
    <br />
    <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Regresar a las Empresas</a>
</div>
@endsection