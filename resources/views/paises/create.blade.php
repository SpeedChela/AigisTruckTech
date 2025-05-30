@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear País</h1>
    <form action="{{ route('paises.store') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="1">
        <label for="nombre">Nombre del país</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del país" required>
        <br><br>
        <label for="clave">Clave del país</label>
        <input type="text" name="clave" id="clave" placeholder="Ingresa clave del país" required>
        <br><br>
        <button type="submit">Guardar País</button>
        <br>
        <a href="{{ route('paises.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection