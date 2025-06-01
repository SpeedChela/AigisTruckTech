@extends('layouts.app')

@section('title', 'Proveedores y Productos')

@push('styles')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Productos por Proveedor</h2>
                    <a href="{{ route('graficas.index') }}" class="btn btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <div id="grafica-proveedores" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const datos = @json($proveedores);
    const seriesData = datos.map(item => ({
        name: item.nombre,
        y: item.refacciones_count
    }));

    Highcharts.chart('grafica-proveedores', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Distribución de Productos por Proveedor'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f}% ({point.y})',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Productos',
            colorByPoint: true,
            data: seriesData
        }],
        credits: {
            enabled: false
        },
        exporting: {
            enabled: true
        }
    });
});
</script>
@endpush
@endsection 