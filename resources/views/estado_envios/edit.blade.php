@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Estado de Envío</h1>
    <form action="{{ route('estado_envios.update', $estado_envio->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_compra">Compra</label>
        <select name="id_compra" id="id_compra" required>
            <option value="">Seleccionar compra</option>
            @foreach($compras as $id => $nombre)
                <option value="{{ $id }}" @if(old('id_compra', $estado_envio->id_compra) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $estado_envio->status) == 1) selected @endif>Enviado</option>
            <option value="0" @if(old('status', $estado_envio->status) == 0) selected @endif>Pendiente</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Estado de Envío</button>
    </form>
    <br>
    <a href="{{ route('estado_envios.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection