@extends('layauts.plantillaLogin')
@section('title', 'Registro Cliente')
@section('content')

    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .input-group {
            position: relative;
        }

        .input-group-addon {
            position: absolute;
            right: 10px;
            top: 15px;
            cursor: pointer;
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
            <input type="text" name="nombre_cliente" placeholder="Nombre completo" required class="form-control {{ $errors->has('nombre_cliente') ? 'is-invalid' : '' }}" value="{{ old('nombre_cliente') }}">
            @if ($errors->has('nombre_cliente'))
                <small class="text-danger">{{ $errors->first('nombre_cliente') }}</small>
            @endif
        </div>

        <div class="form-group">
            <input type="text" name="apellido_cliente" placeholder="Apellidos" required class="form-control {{ $errors->has('apellido_cliente') ? 'is-invalid' : '' }}" value="{{ old('apellido_cliente') }}">
            @if ($errors->has('apellido_cliente'))
                <small class="text-danger">{{ $errors->first('apellido_cliente') }}</small>
            @endif
        </div>

        <div class="form-group">
            <input type="email" name="correo_cliente" placeholder="Correo" required class="form-control {{ $errors->has('correo_cliente') ? 'is-invalid' : '' }}" value="{{ old('correo_cliente') }}">
            @if ($errors->has('correo_cliente'))
                <small class="text-danger">{{ $errors->first('correo_cliente') }}</small>
            @endif
        </div>

        <div class="form-group">
            <div class="input-group" id="show_hide_password">
                <input type="password" name="contra_cliente" id="contra_cliente" placeholder="Contraseña" required class="form-control {{ $errors->has('contra_cliente') ? 'is-invalid' : '' }}">
                <div class="input-group-addon">
                    <a href="javascript:void(0);" id="togglePassword">
                        <i class="fas fa-eye-slash" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            @if ($errors->has('contra_cliente'))
                <small class="text-danger">{{ $errors->first('contra_cliente') }}</small>
            @endif
        </div>


        <div class="form-group">
            <input type="text" name="tele_cliente" placeholder="Teléfono" required class="form-control {{ $errors->has('tele_cliente') ? 'is-invalid' : '' }}" value="{{ old('tele_cliente') }}">
            @if ($errors->has('tele_cliente'))
                <small class="text-danger">{{ $errors->first('tele_cliente') }}</small>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="/" class="btn btn-danger">Cancelar</a>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#togglePassword").on('click', function(event) {
            event.preventDefault();
            var passwordField = $('#show_hide_password input');
            var toggleIcon = $('#togglePassword i');

            if(passwordField.attr("type") === "text") {
                passwordField.attr('type', 'password');
                toggleIcon.addClass("fa-eye-slash");
                toggleIcon.removeClass("fa-eye");
            } else {
                passwordField.attr('type', 'text');
                toggleIcon.removeClass("fa-eye-slash");
                toggleIcon.addClass("fa-eye");
            }
        });
    });
</script>

</body>
</html>


@endsection
