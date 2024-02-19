<!DOCTYPE html>
<html>
<head>
    <title>Correo de Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        li strong {
            display: inline-block;
            min-width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nueva reserva realizada en la olla mágica</h2>
        <p>Se ha realizado una nueva reserva con los siguientes detalles:</p>
        <ul>
            <li><strong>Nombre:</strong> {{ $data['name'] }}</li>
            <li><strong>Email:</strong> {{ $data['email'] }}</li>
            <li><strong>Fecha:</strong> {{ $data['fecha'] }}</li>
            <li><strong>Hora:</strong> {{ $data['hora'] }}</li>
            <li><strong>Tarjeta de Crédito:</strong> {{ $data['tarjeta_credito'] }}</li>
            <li><strong>Número de personas:</strong> {{ $data['numero_personas'] }}</li>
        </ul>
    </div>
</body>
</html>
