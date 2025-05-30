@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Crear Compra</h1>
    <form action="{{ route('compras.store') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="1">
        <label for="id_proveedor">Proveedor</label>
        <select name="proveedor_id" id="proveedor_id" required>
            <option value="">Seleccionar proveedor</option>
            @foreach($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="id_usuario">Usuario</label>
        <select name="usuario_id" id="usuario_id" required>
            <option value="">Seleccionar usuario</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="fecha_compra">Fecha de compra</label>
        <input type="date" name="fecha_compra" id="fecha_compra" required>
        <br><br>
        <label for="total">Total</label>
        <input type="number" name="total" id="total" placeholder="Ingresa total" step="0.01" required>
        <br><br>
        <button type="submit">Guardar Compra</button>
        <br><br>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection