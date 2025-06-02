<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Proveedores</title>
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
        .proveedor-info {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('estilo/images/logo.png') }}" class="logo">
        <h2>Aigis Truck Tech</h2>
    </div>

    <div class="content">
        <h1>Reporte de Proveedores y sus Productos</h1>
        <p>Fecha de generación: {{ $date }}</p>

        @foreach($data as $proveedor)
            <div class="proveedor-info">
                <h3>{{ $proveedor->nombre }}</h3>
                <p><strong>Teléfono:</strong> {{ $proveedor->telefono }}</p>
                <p><strong>Email:</strong> {{ $proveedor->email }}</p>
                <p><strong>Dirección:</strong> {{ $proveedor->direccion }}</p>
                
                <h4>Refacciones suministradas:</h4>
                @if($proveedor->refacciones->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Categoría</th>
                                <th>Stock</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedor->refacciones as $refaccion)
                                <tr>
                                    <td>{{ $refaccion->nombre }}</td>
                                    <td>{{ $refaccion->marca }}</td>
                                    <td>{{ $refaccion->categoria }}</td>
                                    <td>{{ $refaccion->stock }}</td>
                                    <td>${{ number_format($refaccion->precio, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p><em>Este proveedor no tiene refacciones registradas.</em></p>
                @endif
            </div>
        @endforeach

        <div style="margin-top: 20px;">
            <p><strong>Resumen:</strong></p>
            <ul>
                <li>Total de proveedores: {{ count($data) }}</li>
                <li>Total de refacciones: {{ $data->sum(function($proveedor) { return $proveedor->refacciones->count(); }) }}</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>Página 1 de 1</p>
        <p>© {{ date('Y') }} Aigis Truck Tech - Todos los derechos reservados</p>
    </div>
</body>
</html> 