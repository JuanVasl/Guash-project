@extends('layauts.plantillacliente')
@section('title', 'Cliente')
@section('content')
    <div class="container">
            <!-- Título -->
        <div class="container mt-2">
            <div class="col-12">
                <h3 class="text-start"><strong>¿Tienes ropa para lavar?</strong></h3>
            </div>
        </div>

        <!-- Botones de Pedir ahora y Programar pedido -->
        <div class="row mb-3 mt-3">
            <div id="mensaje-intentos-programacion" class="text-center mt-3" style="font-weight: bold; color: red;"></div>
            <div id="mensaje-intentos" class="text-center mt-3" style="font-weight: bold; color: red;"></div>

            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <form action="{{ route('pedidos.iniciar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;" onclick="verificarIntentosRestantes(event)">
                            <div class="d-flex justify-content-center" style="height: 75%;">
                                <img src="https://cdn-icons-png.freepik.com/256/5457/5457874.png" alt="Pedir ahora" style="max-width: 100%; max-height: 100%;">
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                                <p class="mt-5 text-center"><strong>Pedir ahora</strong></p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <form action="{{ route('pedidos.iniciarProgramacion') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;" onclick="verificarIntentosRestantesProgramacion(event)">
                            <div class="d-flex justify-content-center" style="height: 75%;">
                                <img src="https://cdn-icons-png.freepik.com/256/3652/3652267.png" alt="Programar Pedido" style="max-width: 100%; max-height: 100%;">
                            </div>
                            <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                                <p class="mt-5 text-center"><strong>Programar pedido</strong></p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Botón central Historial de pedidos -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <a href="{{ route('pedidos.historial') }}" class="btn w-100">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://cdn-icons-png.freepik.com/256/8798/8798541.png" alt="Historial de pedidos" style="width: 80px; height: 80px; margin-right: 10px;">
                            <h3><strong>Historial de pedidos</strong></h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function verificarIntentosRestantes(event) {
            event.preventDefault(); // Previene el envío inmediato del formulario

            fetch("{{ route('pedidos.verificarIntentos') }}")
                .then(response => response.json())
                .then(data => {
                    // Mostrar el número de intentos restantes en el contenedor
                    document.getElementById('mensaje-intentos').innerText = `Restan ${data.intentos_restantes} intentos por esta hora.`;

                    // Si quedan intentos, después de mostrar el mensaje, envía el formulario automáticamente
                    if (data.intentos_restantes > 0) {
                        setTimeout(() => {
                            event.target.closest('form').submit(); // Envía el formulario después de un breve retraso
                        }, 1500); // Espera 1.5 segundos antes de enviar
                    }
                })
                .catch(error => {
                    console.error('Error al verificar intentos:', error);
                });
        }
    </script>

    <script>
        function verificarIntentosRestantesProgramacion(event) {
            event.preventDefault();

            fetch("{{ route('pedidos.verificarIntentosProgramacion') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('mensaje-intentos-programacion').innerText = `Restan ${data.intentos_restantes} intentos de programación por esta hora.`;

                    if (data.intentos_restantes > 0) {
                        setTimeout(() => {
                            event.target.closest('form').submit();
                        }, 1500);
                    }
                })
                .catch(error => {
                    console.error('Error al verificar intentos de programación:', error);
                });
        }
    </script>

@endsection
