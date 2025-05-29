@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear País</h1>
    <form action="{{ route('paises.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre del país</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del país" required>
        <br><br>
        <label for="clave">Clave del país</label>
        <input type="text" name="clave" id="clave" placeholder="Ingresa clave del país" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar País</button>
    </form>
</div>
@endsection