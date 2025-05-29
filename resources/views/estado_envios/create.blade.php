@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Estado de Envío</h1>
    <form action="{{ route('estado_envios.store') }}" method="POST">
        @csrf
        <label for="id_compra">Compra</label>
        <select name="id_compra" id="id_compra" required>
            <option value="">Seleccionar compra</option>
            @foreach($compras as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Enviado</option>
            <option value="0">Pendiente</option>
        </select>
        <br><br>
        <button type="submit">Guardar Estado de Envío</button>
    </form>
</div>
@endsection