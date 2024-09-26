@extends('layauts.plantillacliente')
@section('title', 'Cliente')
@section('content')
    <div class="container">
        <div class="container mt-5">
            <div class="col-12">
                <h3 class="text-start"><strong>Detalle del Pedido</strong></h3>
            </div>
        </div>

        <!-- Formulario central -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <div class="row">
                        <div class="col-6 text-end">
                            <p><strong>No:</strong></p>
                        </div>
                        <div class="col-6">
                            <p>{{ $pedido->id_pedido }}</p>
                        </div>

                        <div class="col-6 text-end">
                            <p><strong>Fecha y hora:</strong></p>
                        </div>
                        <div class="col-6">
                            <p>{{ $pedido->fecha }}</p>
                        </div>

                        <div class="col-6 text-end">
                            <p><strong>Dirección del Cliente:</strong></p>
                        </div>
                        <div class="col-6">
                            <p>{{ $pedido->cliente->direccion }}, {{ $pedido->cliente->referencia }}, en {{ $pedido->cliente->ubicacion->nombre }}</p>
                        </div>

                        <div class="col-6 text-end">
                            <p><strong>Servicio(s):</strong></p>
                        </div>
                        <div class="col-6">
                            <p>{{ $pedido->precioServicio->servicio }}</p>
                        </div>

                        <div class="col-6 text-end">
                            <p><strong>Precio:</strong></p>
                        </div>
                        <div class="col-6">
                            <p>Pendiente de confirmar por lavandería</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Botón central Historial de pedidos -->
        <div class="row mt-3">
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
@endsection
