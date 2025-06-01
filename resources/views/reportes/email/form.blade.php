@extends('layouts.app')

@section('title', 'Enviar Reporte por Correo')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Enviar Reporte por Correo</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reportes.email.enviar') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tipo_reporte" class="form-label">Tipo de Reporte</label>
                            <select class="form-select @error('tipo_reporte') is-invalid @enderror" 
                                    id="tipo_reporte" name="tipo_reporte" required>
                                <option value="">Seleccione un tipo de reporte</option>
                                <option value="ventas" {{ old('tipo_reporte') == 'ventas' ? 'selected' : '' }}>
                                    Reporte de Ventas
                                </option>
                                <option value="inventario" {{ old('tipo_reporte') == 'inventario' ? 'selected' : '' }}>
                                    Reporte de Inventario
                                </option>
                                <option value="proveedores" {{ old('tipo_reporte') == 'proveedores' ? 'selected' : '' }}>
                                    Reporte de Proveedores
                                </option>
                            </select>
                            @error('tipo_reporte')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Enviar Reporte
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Volver
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 