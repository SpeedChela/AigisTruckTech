@extends('template.master')

@section('contenido_central')
<div class="container-fluid">
    <h2 class="text-center mb-4">Panel de Gráficas</h2>

    <!-- Gráfica de Ventas por Período -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Ventas por Período</h4>
            <form id="formVentas" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Período</label>
                    <select class="form-select" name="periodo" id="periodVentas">
                        <option value="mes">Mensual</option>
                        <option value="semana">Semanal</option>
                        <option value="año">Anual</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" id="fechaInicioVentas">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" id="fechaFinVentas">
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block">Actualizar</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div id="graficaVentas" style="height: 400px;"></div>
        </div>
    </div>

    <!-- Gráfica de Refacciones -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Análisis de Refacciones</h4>
            <form id="formRefacciones" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Tipo de Vista</label>
                    <select class="form-select" name="tipo_vista" id="tipoVistaRefacciones">
                        <option value="stock">Stock Actual</option>
                        <option value="movimientos">Movimientos</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Límite de Productos</label>
                    <input type="number" class="form-control" name="limite" id="limiteRefacciones" value="10" min="5" max="20">
                </div>
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block">Actualizar</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div id="graficaRefacciones" style="height: 400px;"></div>
        </div>
    </div>

    <!-- Gráfica de Compras vs Ventas -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Comparativa Compras vs Ventas</h4>
            <form id="formComprasVentas" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Período</label>
                    <select class="form-select" name="periodo" id="periodoComprasVentas">
                        <option value="mensual">Mensual</option>
                        <option value="diario">Diario</option>
                        <option value="anual">Anual</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Año</label>
                    <select class="form-select" name="año" id="añoComprasVentas">
                        @for($i = date('Y'); $i >= date('Y')-5; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Mes</label>
                    <select class="form-select" name="mes" id="mesComprasVentas">
                        @foreach(['Enero' => 1, 'Febrero' => 2, 'Marzo' => 3, 'Abril' => 4, 'Mayo' => 5, 'Junio' => 6,
                                'Julio' => 7, 'Agosto' => 8, 'Septiembre' => 9, 'Octubre' => 10, 'Noviembre' => 11, 'Diciembre' => 12] as $nombre => $numero)
                            <option value="{{ $numero }}" {{ date('n') == $numero ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block">Actualizar</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div id="graficaComprasVentas" style="height: 400px;"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
$(document).ready(function() {
    // Inicializar fechas por defecto
    const hoy = new Date();
    const seisMesesAtras = new Date();
    seisMesesAtras.setMonth(seisMesesAtras.getMonth() - 6);
    
    $('#fechaInicioVentas').val(seisMesesAtras.toISOString().split('T')[0]);
    $('#fechaFinVentas').val(hoy.toISOString().split('T')[0]);

    // Función para cargar gráfica de ventas
    function cargarGraficaVentas() {
        $.get('{{ route("graficas.ventas_mes") }}', $('#formVentas').serialize(), function(data) {
            Highcharts.chart('graficaVentas', {
                chart: { type: 'line' },
                title: { text: 'Ventas por Período' },
                xAxis: {
                    categories: data.ventas.map(v => v.fecha),
                    title: { text: 'Fecha' }
                },
                yAxis: { title: { text: 'Total Ventas ($)' } },
                series: [{
                    name: 'Ventas',
                    data: data.ventas.map(v => parseFloat(v.total_ventas))
                }]
            });
        });
    }

    // Función para cargar gráfica de refacciones
    function cargarGraficaRefacciones() {
        $.get('{{ route("graficas.refacciones_movimientos") }}', $('#formRefacciones').serialize(), function(data) {
            const config = {
                chart: { type: data.tipo_vista === 'stock' ? 'column' : 'bar' },
                title: { text: data.tipo_vista === 'stock' ? 'Stock de Refacciones' : 'Movimientos de Refacciones' },
                xAxis: {
                    categories: data.refacciones.map(r => r.nombre),
                    title: { text: 'Refacciones' }
                },
                yAxis: { title: { text: data.tipo_vista === 'stock' ? 'Cantidad en Stock' : 'Cantidad de Movimientos' } },
                series: data.tipo_vista === 'stock' ? 
                    [{ name: 'Stock Actual', data: data.refacciones.map(r => r.stock) }] :
                    [
                        { name: 'Ventas', data: data.refacciones.map(r => r.total_vendido) },
                        { name: 'Compras', data: data.refacciones.map(r => r.total_comprado) }
                    ]
            };
            Highcharts.chart('graficaRefacciones', config);
        });
    }

    // Función para cargar gráfica de compras vs ventas
    function cargarGraficaComprasVentas() {
        $.get('{{ route("graficas.compras_vs_ventas") }}', $('#formComprasVentas').serialize(), function(data) {
            Highcharts.chart('graficaComprasVentas', {
                chart: { type: 'line' },
                title: { text: 'Comparativa de Compras vs Ventas' },
                xAxis: {
                    categories: data.compras.map(c => c.fecha),
                    title: { text: 'Fecha' }
                },
                yAxis: { title: { text: 'Monto ($)' } },
                series: [{
                    name: 'Compras',
                    data: data.compras.map(c => parseFloat(c.total_compras))
                }, {
                    name: 'Ventas',
                    data: data.ventas.map(v => parseFloat(v.total_ventas))
                }]
            });
        });
    }

    // Event listeners para los formularios
    $('#formVentas').on('submit', function(e) {
        e.preventDefault();
        cargarGraficaVentas();
    });

    $('#formRefacciones').on('submit', function(e) {
        e.preventDefault();
        cargarGraficaRefacciones();
    });

    $('#formComprasVentas').on('submit', function(e) {
        e.preventDefault();
        cargarGraficaComprasVentas();
    });

    // Cargar gráficas iniciales
    cargarGraficaVentas();
    cargarGraficaRefacciones();
    cargarGraficaComprasVentas();
});
</script>
@endpush
@endsection 