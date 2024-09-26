<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUASH-@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .main-content {
            flex: 1;
            padding-bottom: 15vh; /* Ajusta este valor según la altura de tu footer */
        }
        .container {
            text-align: center;
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        footer {
            height: 11vh;
            background-color: black;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .offcanvas-end {
            max-width: 350px;
            background-color: rgb(217, 217, 217);
        }
        .btn-custom {
            border: none;
            color: white;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .btn-custom i {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .container-fluid .btn-custom + .btn-custom {
            margin-left: 40px;
        }
        .btn-custom img {
            width: 50px;
            height: 50px;
            margin-bottom: 5px;
        }
        .offcanvas-header {
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            padding: 20px;
        }
        .offcanvas-header .image-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .offcanvas-header img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
        }
        .offcanvas-header .data-container {
            flex: 2;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        .offcanvas-header .data-container p {
            margin: 5px 0;
        }
        .offcanvas-body ul li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .offcanvas-body ul li img {
            width: 40px;
            height: 40px;
            margin-right: 8px;
        }
        .logout-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .offcanvas-body ul li a {
            color: black;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="container">
        <!-- Logotipo y Texto de Bienvenida -->
        <div class="row">
            <div class="col-4 justify-content-center">
                <img src="{{ asset('images/logo_guash.png') }}" alt="Logotipo" class="img-fluid">
            </div>
            <div class="col-8 d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-center"><strong>Bienvenido(a)</strong></h2>
                <p class="text-center"><strong>{{ Auth::user()->nombre_cliente }} {{ Auth::user()->apellido_cliente }}</strong></p>
            </div>
        </div>

        @yield('content')
    </div>
</div>

<!-- Footer con Navbar -->
<footer class="text-center text-lg-start">
    <div class="container">
        <nav class="navbar navbar-light">
            <div class="container-fluid justify-content-center">
                <!-- Botón Inicio -->
                <a href="{{ url('/menu') }}" class="btn btn-custom">
                    <img src="https://cdn-icons-png.freepik.com/256/3672/3672451.png" alt="Inicio">
                    Inicio
                </a>

                <!-- Botón Ayuda (WhatsApp) -->
                <a href="https://wa.me/50254749500?text=Soy%20cliente%20de%20Güash,%20necesito%20ayuda%20con..." target="_blank" class="btn btn-custom">
                    <img src="https://cdn-icons-png.freepik.com/256/1688/1688401.png" alt="Ayuda">
                    Ayuda
                </a>

                <!-- Botón para abrir Offcanvas (Más) -->
                <button class="btn btn-custom" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <img src="https://cdn-icons-png.freepik.com/256/459/459545.png" alt="Más">
                    Más
                </button>
            </div>
        </nav>
    </div>
</footer>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <!-- Header con la ficha del cliente -->
    <div class="offcanvas-header">
        <!-- Contenedor de imagen (1/3) -->
        <div class="image-container">
            <img src="https://cdn-icons-png.freepik.com/256/11748/11748483.png" alt="Foto de perfil">
        </div>
        <!-- Contenedor de datos (2/3) -->
        <div class="data-container">
            <p><strong>{{ Auth::user()->nombre_cliente }} {{ Auth::user()->apellido_cliente }}</strong></p>
            <p><strong>+502 {{ Auth::user()->tele_cliente }}</strong></p>
            <p><strong>{{ Auth::user()->correo_cliente }}</strong></p>
        </div>
    </div>

    <!-- Offcanvas body -->
    <div class="offcanvas-body">
        <ul class="list-unstyled">
            <li>
                <img src="https://cdn-icons-png.freepik.com/256/8647/8647311.png" alt="Mi Cuenta">
                <a href="#" class="text-decoration-none">Mi Cuenta</a>
            </li>
            <li>
                <img src="https://cdn-icons-png.freepik.com/256/8567/8567809.png" alt="Notificaciones">
                <a href="#" class="text-decoration-none">Notificaciones</a>
            </li>
            <li>
                <img src="https://cdn-icons-png.freepik.com/256/16096/16096220.png" alt="Información">
                <a href="https://wa.me/50254749500?text=Necesito%20información%20sobre%20Güash,%20en%20..." class="text-decoration-none">Información</a>
            </li>
            <li>
                <img src="https://cdn-icons-png.freepik.com/256/12343/12343346.png" alt="Términos y Condiciones">
                <a href="https://www.gnu.org/licenses/gpl-3.0.html#license-text" class="text-decoration-none">Términos y Condiciones</a>
            </li>
        </ul>
    </div>

    <!-- Sección de Cerrar sesión y Versión -->
    <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
        <br>
        <p>Versión 1.0.3</p>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
</div>
</body>
</html>
