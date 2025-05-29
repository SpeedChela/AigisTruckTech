@extends('template.master')

@section('contenido')
<div class="container">
    <h1>Editar Compra</h1>
    <form action="{{ route('compras.update', $compra->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="id_proveedor">Proveedor</label>
        <select name="proveedor_id" id="proveedor_id" required>
        <option value="">Seleccionar proveedor</option>
            @foreach($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}" @if(old('proveedor_id', $compra->proveedor_id) == $proveedor->id) selected @endif>
                    {{ $proveedor->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>
        <label for="id_usuario">Usuario</label>
       <select name="usuario_id" id="usuario_id" required>
            <option value="">Seleccionar usuario</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" @if(old('usuario_id', $compra->usuario_id) == $usuario->id) selected @endif>
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>
        <label for="fecha_compra">Fecha de compra</label>
        <input type="date" name="fecha_compra" id="fecha_compra" value="{{ old('fecha_compra', $compra->fecha_compra) }}" required>
        <br><br>
        <label for="total">Total</label>
        <input type="number" name="total" id="total" value="{{ old('total', $compra->total) }}" step="0.01" required>
        <br><br>
        <label for="status">Estatus:</label>
        <select name="status" id="status" required>
            <option value="">Seleccionar ...</option>
            <option value="1" @if(old('status', $compra->status) == 1) selected @endif>Activo</option>
            <option value="0" @if(old('status', $compra->status) == 0) selected @endif>Baja</option>
        </select>
        <br><br>
        <button type="submit">Actualizar Compra</button>
    </form>
    <br>
    <a href="{{ route('compras.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection