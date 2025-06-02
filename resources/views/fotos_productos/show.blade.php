@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Detalles de la Foto</h2>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/fotografias/' . $fotos_producto->ruta) }}" 
                             alt="Foto de {{ $fotos_producto->producto->nombre }}" 
                             style="max-width: 100%; height: auto;">
                    </div>

                    <div class="info-container">
                        <h4>Información del Producto</h4>
                        <p><strong>Producto:</strong> {{ $fotos_producto->producto->nombre }}</p>
                        <p><strong>Nombre del archivo:</strong> {{ $fotos_producto->ruta }}</p>
                        <p><strong>Estado:</strong> {{ $fotos_producto->status ? 'Activo' : 'Inactivo' }}</p>
                    </div>

                    <div class="actions mt-4">
                        <a href="{{ route('fotos_productos.edit', $fotos_producto->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('fotos_productos.index') }}" class="btn btn-secondary">Volver al Listado</a>
                        
                        <form action="{{ route('fotos_productos.destroy', $fotos_producto->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta foto?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 