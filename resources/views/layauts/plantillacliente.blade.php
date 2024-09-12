<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUASH-@yield('title')</title> <!--nombre de la pagina-->

    <!--Booptstrap se agrega manualmente-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        footer {
            background-color: black;
        }
        .offcanvas-end {
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
            flex: 1; /* 1/3 del espacio */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .offcanvas-header img {
            width: 90px; /* Ajusta el tamaño de la imagen */
            height: 90px;
            border-radius: 50%;
        }
        .offcanvas-header .data-container {
            flex: 2; /* 2/3 del espacio */
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
<body style="background-color: white">

<div class="container">
    @yield('content') <!-- es para que se herede en todas las plantillas-->
</div>
<!-- Footer con Navbar -->
<footer class="text-center text-lg-start fixed-bottom">
    <div class="container p-4">
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
        <!-- Botón de cierre del Offcanvas -->
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>