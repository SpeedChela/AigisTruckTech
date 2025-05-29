@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Venta</h1>
    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_usuario">Usuario</label>
        <select name="id_usuario" id="id_usuario" required>
            <option value="">Seleccionar usuario</option>
            @foreach($usuarios as $id => $nombre)
                <option value="{{ $id }}" @if(old('id_usuario', $venta->id_usuario) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="id_cliente">Cliente</label>
        <select name="id_cliente" id="id_cliente" required>
            <option value="">Seleccionar cliente</option>
            @foreach($clientes as $id => $nombre)
                <option value="{{ $id }}" @if(old('id_cliente', $venta->id_cliente) == $id) selected @endif>{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="fecha_venta">Fecha de venta</label>
        <input type="date" name="fecha_venta" id="fecha_venta" value="{{ old('fecha_venta', $venta->fecha_venta) }}" required>
        <br><br>
        <label for="total">Total</label>
        <input type="number" name="total" id="total" value="{{ old('total', $venta->total) }}" step="0.01" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $venta->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $venta->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Venta</button>
    </form>
    <br>
    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection