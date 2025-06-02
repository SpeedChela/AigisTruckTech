<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
        .fecha {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Compras</h1>
        <p>AIGIS Truck Tech</p>
    </div>

    <div class="fecha">
        <p>Fecha de generación: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Productos</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total_general = 0; @endphp
            @foreach($data as $compra)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>
                        @foreach($compra->detalles as $detalle)
                            - {{ $detalle->refaccion->nombre }} ({{ $detalle->cantidad }})<br>
                        @endforeach
                    </td>
                    <td>{{ $compra->detalles->sum('cantidad') }}</td>
                    <td>${{ number_format($compra->subtotal, 2) }}</td>
                    <td>${{ number_format($compra->iva, 2) }}</td>
                    <td>${{ number_format($compra->total, 2) }}</td>
                </tr>
                @php $total_general += $compra->total; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total General: ${{ number_format($total_general, 2) }}</p>
    </div>

    <div style="margin-top: 30px;">
        <p><strong>Resumen:</strong></p>
        <p>Total de compras: {{ count($data) }}</p>
        <p>Promedio por compra: ${{ number_format($total_general / (count($data) ?: 1), 2) }}</p>
    </div>
</body>
</html> 