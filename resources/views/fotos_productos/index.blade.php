@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Fotos de Productos</h2>
                    <a href="{{ route('fotos_productos.create') }}" class="btn btn-primary">Agregar Nueva Foto</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach($fotos_productos as $foto)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-img-container" style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                        <img src="{{ asset('storage/fotografias/' . $foto->ruta) }}" 
                                             class="img-fluid" 
                                             alt="Foto de {{ $foto->producto->nombre }}"
                                             style="max-height: 100%; width: auto; object-fit: contain;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $foto->producto->nombre }}</h5>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('fotos_productos.show', $foto->id) }}" class="btn btn-info btn-sm">Ver</a>
                                            <a href="{{ route('fotos_productos.edit', $foto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                            <form action="{{ route('fotos_productos.destroy', $foto->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta foto?')">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-img-container {
    border-bottom: 1px solid #dee2e6;
}

.gap-2 {
    gap: 0.5rem !important;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>
@endsection 