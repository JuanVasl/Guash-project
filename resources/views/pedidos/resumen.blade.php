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
                <h3 class="text-start"><strong>Detalle del Pedido</strong></h3>
            </div>
        </div>

        <!-- Formulario central -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <div>
                        <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
                        <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
                        <p><strong>Dirección de recolección:</strong> {{ $pedido->cliente->direccion }}</p>
                        <p><strong>Servicio seleccionado:</strong> {{ $pedido->precioServicio->nombre }}</p>
                        <p><strong>Precio:</strong> ${{ $pedido->precioServicio->precio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
