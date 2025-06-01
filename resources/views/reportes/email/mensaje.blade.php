<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1e3d59;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Aigis Truck Tech</h1>
        </div>
        
        <div class="content">
            <h2>{{ $tipo }}</h2>
            
            <p>Estimado usuario,</p>
            
            <p>Adjunto encontrará el {{ $tipo }} que ha solicitado. Este reporte fue generado automáticamente el {{ date('d/m/Y') }} a las {{ date('H:i') }} horas.</p>
            
            <p>El reporte incluye la información más reciente disponible en nuestro sistema.</p>
            
            <p>Si tiene alguna pregunta o necesita aclaraciones sobre el contenido del reporte, no dude en contactarnos.</p>
            
            <p>Saludos cordiales,<br>
            Equipo de Aigis Truck Tech</p>
        </div>
        
        <div class="footer">
            <p>Este es un correo automático, por favor no responda a esta dirección.</p>
            <p>© {{ date('Y') }} Aigis Truck Tech - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html> 