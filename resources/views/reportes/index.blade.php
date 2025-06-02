@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Reportes PDF</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Reporte de Ventas -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Reporte de Ventas</h5>
                                    <p class="card-text">Genera un reporte detallado de las ventas realizadas.</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('reportes.ventas', 1) }}" class="btn btn-primary" target="_blank">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('reportes.ventas', 2) }}" class="btn btn-success">
                                            <i class="fas fa-download"></i> Descargar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reporte de Compras -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Reporte de Compras</h5>
                                    <p class="card-text">Genera un reporte detallado de las compras realizadas.</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('reportes.compras', 1) }}" class="btn btn-primary" target="_blank">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('reportes.compras', 2) }}" class="btn btn-success">
                                            <i class="fas fa-download"></i> Descargar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reporte de Inventario -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Reporte de Inventario</h5>
                                    <p class="card-text">Muestra el estado actual del inventario de refacciones.</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('reportes.inventario', 1) }}" class="btn btn-primary" target="_blank">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('reportes.inventario', 2) }}" class="btn btn-success">
                                            <i class="fas fa-download"></i> Descargar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reporte de Proveedores -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Reporte de Proveedores</h5>
                                    <p class="card-text">Lista de proveedores y sus productos asociados.</p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('reportes.proveedores', 1) }}" class="btn btn-primary" target="_blank">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('reportes.proveedores', 2) }}" class="btn btn-success">
                                            <i class="fas fa-download"></i> Descargar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enviar por Correo -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">¿Necesitas enviar un reporte por correo?</h5>
                                    <p class="card-text">Puedes enviar cualquiera de estos reportes por correo electrónico.</p>
                                    <a href="{{ route('reportes.email.form') }}" class="btn btn-info">
                                        <i class="fas fa-envelope"></i> Enviar por Correo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 