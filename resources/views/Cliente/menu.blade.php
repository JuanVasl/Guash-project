@extends('layauts.plantillacliente')
@section('title', 'Cliente')
@section('content')
    <div class="container">
        <!-- Logotipo y Texto de Bienvenida -->
        <div class="row mb-5">
            <div class="col-4 justify-content-center">
                <img src="{{ asset('images/logo_guash.png') }}" alt="Logotipo" class="img-fluid">
            </div>
            <div class="col-8 d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-center"><strong>Bienvenido(a)</strong></h2>
                <p class="text-center"><strong>{{ Auth::user()->nombre_cliente }} {{ Auth::user()->apellido_cliente }}</strong></p>
            </div>
        </div>

        <!-- Título -->
        <div class="container mt-5">
            <div class="col-12">
                <h3 class="text-start"><strong>¿Tienes ropa para lavar?</strong></h3>
            </div>
        </div>

        <!-- Botones de Pedir ahora y Programar pedido -->
        <div class="row mb-3 mt-3">
            <div class="col-6 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px;">
                    <form action="{{ route('pedidos.iniciar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
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
                    <a href="https://www.google.com/travel/flights?hl=es" class="btn w-100 d-flex flex-column align-items-center" style="height: 170px;">
                        <div class="d-flex justify-content-center" style="height: 75%;">
                            <img src="https://cdn-icons-png.freepik.com/256/3652/3652267.png" alt="Programar pedido" style="max-width: 100%; max-height: 100%;">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="height: 25%;">
                            <p class="mt-5 text-center"><strong>Programar pedido</strong></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Botón central Historial de pedidos -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <a href="https://www.youtube.com/" class="btn w-100">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="https://cdn-icons-png.freepik.com/256/8798/8798541.png" alt="Historial de pedidos" style="width: 80px; height: 80px; margin-right: 10px;">
                            <h3><strong>Historial de pedidos</strong></h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
