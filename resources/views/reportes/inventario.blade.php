<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario</title>
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
        .alerta {
            color: #dc3545;
            font-weight: bold;
        }
        .normal {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('estilo/images/logo.png') }}" class="logo">
        <h2>Aigis Truck Tech</h2>
    </div>

    <div class="content">
        <h1>Reporte de Inventario</h1>
        <p>Fecha de generación: {{ $date }}</p>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Proveedor</th>
                    <th>Stock</th>
                    <th>Precio Unitario</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @php $valor_total_inventario = 0; @endphp
                @foreach($data as $refaccion)
                    @php 
                        $valor_total = $refaccion->stock * $refaccion->precio;
                        $valor_total_inventario += $valor_total;
                    @endphp
                    <tr>
                        <td>{{ $refaccion->codigo }}</td>
                        <td>{{ $refaccion->nombre }}</td>
                        <td>{{ $refaccion->proveedor->nombre }}</td>
                        <td class="{{ $refaccion->stock < 10 ? 'alerta' : 'normal' }}">
                            {{ $refaccion->stock }}
                        </td>
                        <td>${{ number_format($refaccion->precio, 2) }}</td>
                        <td>${{ number_format($valor_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold;">Valor Total del Inventario:</td>
                    <td style="font-weight: bold;">${{ number_format($valor_total_inventario, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div style="margin-top: 20px;">
            <p><strong>Notas:</strong></p>
            <ul>
                <li>Los productos marcados en rojo tienen stock bajo (menos de 10 unidades)</li>
                <li>Precios en pesos mexicanos (MXN)</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>Página 1 de 1</p>
        <p>© {{ date('Y') }} Aigis Truck Tech - Todos los derechos reservados</p>
    </div>
</body>
</html> 