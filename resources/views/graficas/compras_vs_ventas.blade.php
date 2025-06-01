@extends('template.master')

@section('contenido_central')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Comparativa de Compras vs Ventas</h3>
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
    Highcharts.chart('graficaComprasVentas', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Comparativa de Compras vs Ventas'
        },
        xAxis: {
            categories: {!! json_encode($compras->pluck('fecha')) !!},
            title: {
                text: 'Fecha'
            }
        },
        yAxis: {
            title: {
                text: 'Monto ($)'
            }
        },
        series: [{
            name: 'Compras',
            data: {!! json_encode($compras->pluck('total_compras')) !!}
        }, {
            name: 'Ventas',
            data: {!! json_encode($ventas->pluck('total_ventas')) !!}
        }]
    });
});
</script>
@endpush
@endsection 