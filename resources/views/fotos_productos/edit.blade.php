@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Editar Foto de Producto</h2>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <h4>Foto Actual</h4>
                        <img src="{{ asset('storage/fotografias/' . $fotos_producto->ruta) }}" 
                             alt="Foto de {{ $fotos_producto->producto->nombre }}" 
                             style="max-width: 300px; height: auto;">
                    </div>

                    <form method="POST" action="{{ route('fotos_productos.update', $fotos_producto->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="producto_id">Producto</label>
                            <select name="producto_id" id="producto_id" class="form-control" required>
                                <option value="">Seleccionar Producto...</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" 
                                        {{ $fotos_producto->producto_id == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="foto">Nueva Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">
                                Formatos soportados: {{ implode(', ', $formatos_soportados) }}. 
                                Tamaño máximo: 2MB. 
                                Deja este campo vacío si no deseas cambiar la foto.
                            </small>
                        </div>

                        <input type="hidden" name="status" value="{{ $fotos_producto->status }}">

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Actualizar Foto</button>
                            <a href="{{ route('fotos_productos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 