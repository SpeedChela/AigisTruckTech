@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Agregar Nueva Foto de Producto</h2>
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

                    <form method="POST" action="{{ route('fotos_productos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="producto_id">Producto</label>
                            <select name="producto_id" id="producto_id" class="form-control" required>
                                <option value="">Seleccionar Producto...</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                            <small class="form-text text-muted">
                                Formatos soportados: {{ implode(', ', $formatos_soportados) }}. 
                                Tamaño máximo: 2MB
                            </small>
                        </div>

                        <input type="hidden" name="status" value="1">

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Guardar Foto</button>
                            <a href="{{ route('fotos_productos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 