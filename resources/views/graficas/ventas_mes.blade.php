@extends('layouts.app')

@section('title', 'Ventas por Mes')

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
                    <h2 class="mb-0">Ventas por Mes</h2>
                    <a href="{{ route('graficas.index') }}" class="btn btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <div id="grafica-ventas" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    
    const datos = @json($ventas);
    const categorias = [];
    const valores = [];
    
    datos.forEach(venta => {
        categorias.push(meses[venta.mes - 1] + ' ' + venta.año);
        valores.push(parseFloat(venta.total_ventas));
    });

    Highcharts.chart('grafica-ventas', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Ventas Mensuales'
        },
        xAxis: {
            categories: categorias,
            title: {
                text: 'Mes'
            }
        },
        yAxis: {
            title: {
                text: 'Total de Ventas ($)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return '$' + Highcharts.numberFormat(this.y, 2);
                    }
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Ventas',
            data: valores,
            color: '#1e3d59'
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