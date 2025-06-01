@extends('template.master')

@section('contenido_central')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Ventas por Período</h3>
        </div>
        <div class="card-body">
            <div id="graficaVentas" style="height: 400px;"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
$(document).ready(function() {
    Highcharts.chart('graficaVentas', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Ventas por Período'
        },
        xAxis: {
            categories: {!! json_encode($ventas->pluck('fecha')) !!},
            title: {
                text: 'Fecha'
            }
        },
        yAxis: {
            title: {
                text: 'Total Ventas ($)'
            }
        },
        series: [{
            name: 'Ventas',
            data: {!! json_encode($ventas->pluck('total_ventas')) !!}
        }]
    });
});
</script>
@endpush
@endsection 