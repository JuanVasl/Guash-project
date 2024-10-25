@extends('layauts.base')
@section('title', 'Detalles del Pedido')
@section('content')
<!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Detalles de Pedido</strong></h3>
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
            <div class="text-center">
                <h5><strong>Pedido ID: {{ $pedido->id_pedido }} - Fecha: {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/y') }}</strong></h5>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label><strong>Dirección:</strong></label>
                <p>{{ $cliente->direccion }} {{ $cliente->referencia }}</p>
            </div>
            <div class="form-group d-flex justify-content-center">
                <label><strong>Cliente:</strong></label>
                <p>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-center ">
                <label><strong>Teléfono:</strong></label>
                <p>{{ $cliente->tele_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-center">
                <label><strong>Servicio:</strong></label>
                <p>{{ $servicios->servicio }}</p>
            </div>
            <div class="form-group d-flex justify-content-center">
                <label><strong>Canastos:</strong></label>
                <p>{{ $pedido->cant_canasto }}</p>
            </div>
            <div class="form-group d-flex justify-content-center">
                <label><strong>Cobro de Servicio:</strong></label>
                <p>{{ $servicios->moneda ?? 'Q' }}{{ $pedido->total_servicio }}</p>
            </div>

            <div class="links">
                <a href="{{ route('historial.pedidos') }}" class="btn btn-danger">Retroceder</a> <!-- Solo botón para retroceder -->
            </div>
        </div>
    </div>
</div>

@endsection
