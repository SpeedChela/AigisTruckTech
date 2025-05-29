@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Estado</h1>
    <form action="{{ route('estados.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre del estado</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del estado" required>
        <br><br>
        <label for="clave">Clave del estado</label>
        <input type="text" name="clave" id="clave" placeholder="Ingresa clave del estado" required>
        <br><br>
        <label for="pais_id">País</label>
        <select name="pais_id" id="pais_id" required>
            <option value="">Seleccionar ...</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar Estado</button>
    </form>
</div>
@endsection