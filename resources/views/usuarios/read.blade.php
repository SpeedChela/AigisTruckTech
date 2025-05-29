@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Detalle del Usuario</h1>
    <h2>Nombre: {{ $usuario->nombre }}</h2>
    <h2>Email: {{ $usuario->email }}</h2>
    <h2>Teléfono: {{ $usuario->telefono }}</h2>
    <h2>Rol: {{ $usuario->rol }}</h2>
    <h2>Status: {{ $usuario->status }}</h2>
    <h2>ID: {{ $usuario->id }}</h2>
    <br />
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Regresar a los Usuarios</a>
</div>
@endsection