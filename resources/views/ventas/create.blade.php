@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <label for="id_usuario">Usuario</label>
        <select name="id_usuario" id="id_usuario" required>
            <option value="">Seleccionar usuario</option>
            @foreach($usuarios as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="id_cliente">Cliente</label>
        <select name="id_cliente" id="id_cliente" required>
            <option value="">Seleccionar cliente</option>
            @foreach($clientes as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="fecha_venta">Fecha de venta</label>
        <input type="date" name="fecha_venta" id="fecha_venta" required>
        <br><br>
        <label for="total">Total</label>
        <input type="number" name="total" id="total" placeholder="Ingresa total" step="0.01" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1">Activo</option>
            <option value="0">Baja</option>
        </select>
        <br><br>
        <button type="submit">Guardar Venta</button>
    </form>
</div>
@endsection