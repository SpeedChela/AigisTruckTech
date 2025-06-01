@extends('template.master')

@section('contenido_central')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>{{ $tipo_vista === 'stock' ? 'Stock de Refacciones' : 'Movimientos de Refacciones' }}</h3>
        </div>
        <div class="card-body">
            <div id="graficaRefacciones" style="height: 400px;"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
$(document).ready(function() {
    Highcharts.chart('graficaRefacciones', {
        chart: {
            type: '{{ $tipo_vista === "stock" ? "column" : "bar" }}'
        },
        title: {
            text: '{{ $tipo_vista === "stock" ? "Stock Actual de Refacciones" : "Movimientos de Refacciones" }}'
        },
        xAxis: {
            categories: {!! json_encode($refacciones->pluck('nombre')) !!},
            title: {
                text: 'Refacciones'
            }
        },
        yAxis: {
            title: {
                text: '{{ $tipo_vista === "stock" ? "Cantidad en Stock" : "Cantidad de Movimientos" }}'
            }
        },
        series: [
            @if($tipo_vista === 'stock')
            {
                name: 'Stock Actual',
                data: {!! json_encode($refacciones->pluck('stock')) !!}
            }
            @else
            {
                name: 'Ventas',
                data: {!! json_encode($refacciones->pluck('total_vendido')) !!}
            },
            {
                name: 'Compras',
                data: {!! json_encode($refacciones->pluck('total_comprado')) !!}
            }
            @endif
        ]
    });
});
</script>
@endpush
@endsection 