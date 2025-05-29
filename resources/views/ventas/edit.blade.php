@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Venta</h1>
    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_usuario">Usuario</label>
       <select name="usuario_id" id="usuario_id" required>
            <option value="">Seleccionar usuario</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" @if(isset($venta) && old('usuario_id', $venta->usuario_id) == $usuario->id) selected @endif>
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>
        <label for="id_cliente">Cliente</label>
        <select name="cliente_id" id="cliente_id" required>
            <option value="">Seleccionar cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" @if(isset($venta) && old('cliente_id', $venta->cliente_id) == $cliente->id) selected @endif>
                    {{ $cliente->nombre }}
                </option>
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