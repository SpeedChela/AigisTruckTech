<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 3cm 2cm 2cm 2cm;
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 2cm;
            text-align: center;
            border-bottom: 1px solid #1e3d59;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2cm;
            text-align: center;
            border-top: 1px solid #1e3d59;
        }
        .content {
            margin-top: 1cm;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #1e3d59;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('estilo/images/logo.png') }}" class="logo">
        <h2>Aigis Truck Tech</h2>
    </div>

    <div class="content">
        <h1>Reporte de Ventas</h1>
        <p>Fecha de generación: {{ $date }}</p>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Productos</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total_general = 0; @endphp
                @foreach($data as $venta)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</td>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td>
                            <ul>
                                @foreach($venta->detalles as $detalle)
                                    <li>{{ $detalle->refaccion->nombre }} ({{ $detalle->cantidad }} unidades)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                    </tr>
                    @php $total_general += $venta->total; @endphp
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p>Total General: ${{ number_format($total_general, 2) }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Página 1 de 1</p>
        <p>© {{ date('Y') }} Aigis Truck Tech - Todos los derechos reservados</p>
    </div>
</body>
</html> 