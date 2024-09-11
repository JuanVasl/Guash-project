@extends('layauts.base')
@section('title', 'Registro Cliente')
@section('content')

    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        /* Estilos generales */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Botones */
        .btn {
            border: none;
            color: white;
            padding: 10px 5px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 50px;
            width: 55%;
            margin: 10px auto;
            display: block;
        }

        .btn-success {
            background-color: #28a745; /* Verde */
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-warning {
            background-color: #ffc107; /* Amarillo */
            color: white;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545; /* Rojo */
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }


        /* Logo */
        .logo img {
            width: 50%;
            max-width: 150px;
            margin-bottom: 20px;
        }

        /* Estilo para el título */
        h1 {
            font-weight: bold;
        }

        /* Media Queries para dispositivos móviles */
        @media screen and (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="{{ asset('images/logo_guash.png') }}" alt="GÜASH Logo">
    </div>
    <h1>Registrate</h1>
    <form method="POST" action="{{ route('registroCliente') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="nombre_cliente" placeholder="Nombre" required class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="apellido_cliente" placeholder="Apellidos" required class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="correo_cliente" placeholder="Correo" required class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="contra_cliente" placeholder="Contraseña" required class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="tele_cliente" placeholder="Telefono" required class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <div class="links">
            <a href="/" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>

@endsection
