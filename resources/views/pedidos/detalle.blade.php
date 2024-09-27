@extends('layauts.plantillacliente')
@section('title', 'Detalles del Pedido')
@section('content')
    <div class="container">
        <h3 class="my-4">Detalles del pedido</h3>
        <div class="card" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
            <div class="card-body">
                <p class="text-start"><strong># {{ $pedido->id_pedido }}</strong></p>
                <p><strong>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}</strong></p>
                <p><strong>Dirección:</strong> {{ $pedido->cliente->direccion }}, {{ $pedido->cliente->referencia }}, en {{ $pedido->cliente->ubicacion->nombre }}</p>
                <p><strong>Servicio:</strong> {{ $pedido->precioServicio->servicio ?? 'N/A' }}</p>
                <p><strong>Estado:</strong> {{ $pedido->estado->estado ?? 'N/A' }}</p>
                <p><strong>Precio final:</strong> {{ $pedido->total_servicio ?? 'Pendiente de confirmación' }}</p>
            </div>
        </div>
        <!-- Botón central Historial de pedidos -->
        <div class="row mt-4">
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
