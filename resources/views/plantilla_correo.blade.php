<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Correo de Aigis Truck Tech</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #1e3d59;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
        }

        .logo-container {
            background-color: #ffffff;
            padding: 15px;
            text-align: center;
        }

        .content {
            background-color: #ffffff;
            padding: 30px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .mensaje {
            color: #333333;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            text-align: center;
            border-top: 3px solid #1e3d59;
        }

        .contact-info {
            color: #666666;
            font-size: 14px;
            margin-top: 15px;
        }

        .social-links {
            margin-top: 15px;
        }

        .disclaimer {
            font-size: 12px;
            color: #999999;
            margin-top: 15px;
        }

        .separator {
            border: 1px solid #e9ecef;
            margin: 20px 0;
        }

        .highlight {
            color: #1e3d59;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Aigis Truck Tech</h1>
        <div style="font-size: 16px; margin-top: 5px;">Especialistas en Refacciones de Tractocamiones</div>
    </div>

    <div class="logo-container">
        <div style="font-size: 24px; color: #1e3d59; font-weight: bold;">🚛 ATT</div>
    </div>

    <div class="content">
        <div class="mensaje">
            {!! $contenido !!}
        </div>
    </div>

    <div class="footer">
        <div class="highlight">Aigis Truck Tech</div>
        <div class="contact-info">
            Expertos en Refacciones y Mantenimiento de Tractocamiones<br>
            Servicio y Calidad Garantizada
        </div>
        
        <div class="separator"></div>
        
        <div class="contact-info">
            📍 Dirección: [Tu Dirección]<br>
            📞 Teléfono: [Tu Teléfono]<br>
            📧 Email: info@aigistrucktech.com<br>
            🌐 Website: www.aigistrucktech.com
        </div>

        <div class="disclaimer">
            Este correo electrónico es confidencial y está destinado únicamente para el destinatario mencionado.
        </div>
    </div>
</body>
</html> 