<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
</head>
<style>
        /* Estilos para la página de error */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 100px;
            margin-bottom: 0px;
        }

        h2 {
            font-size: 125px;
            margin-top: 0px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        /* Estilos para el botón */
        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        }

        .btn-primary:active {
            background-color: #004085;
            border-color: #003366;
            transform: translateY(1px);
        }
    </style>
<body>
    <div>
        <h1>Error</h1>
        <h2>4<img src="https://cdn-icons-png.flaticon.com/128/10055/10055675.png" >4</h2>
        <p>¿Te has perdido? No te preocupers</p>
        <a href="{{ url('/') }}" class="btn-primary">Regresa aqui</a>
    </div>
</body>
</html>
