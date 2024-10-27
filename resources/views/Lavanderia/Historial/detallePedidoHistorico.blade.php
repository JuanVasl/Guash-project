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
            <div class="form-group d-flex justify-content-start">
                <label><strong>Dirección:</strong></label>
                <p>{{ $cliente->direccion }}, {{ $cliente->referencia }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Cliente:</strong></label>
                <p>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-start ">
                <label><strong>Teléfono:</strong></label>
                <p>{{ $cliente->tele_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Servicio:</strong></label>
                <p>{{ $servicios->servicio }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Canastos:</strong></label>
                <p>{{ $pedido->cant_canasto }}</p>
                <span style="margin: 0 15px;"></span>
                <label><strong> Cobro de Servicio:</strong></label>
                <p>{{ $servicios->moneda ?? 'Q' }}{{ $pedido->total_servicio }}</p>
            </div>
            <!-- Mostrar Lavadora o Secadora asignada -->
            @if ($pedido->id_precio_serv == 1) <!-- Si es Lavado -->
                <div class="form-group d-flex justify-content-start">
                    <label><strong>Lavadora:</strong></label>
                    <p>{{ $lavadoraAsignada->marca ?? 'No asignada' }} (LAV {{ $lavadoraAsignada->id_maquina ?? '-' }})</p>
                </div>
            @elseif ($pedido->id_precio_serv == 2) <!-- Si es Secado -->
                <div class="form-group d-flex justify-content-start">
                    <label><strong>Secadora:</strong></label>
                    <p>{{ $secadoraAsignada->marca ?? 'No asignada' }} (SEC {{ $secadoraAsignada->id_maquina ?? '-' }})</p>
                </div>
            @elseif ($pedido->id_precio_serv == 3) <!-- Si es Lavado y Secado -->
                <div class="form-group d-flex justify-content-start">
                    <label><strong>Lavadora:</strong></label>
                    <p>{{ $lavadoraAsignada->marca ?? 'No asignada' }} (LAV {{ $lavadoraAsignada->id_maquina ?? '-' }})</p>
                </div>
                <div class="form-group d-flex justify-content-start">
                    <label><strong>Secadora:</strong></label>
                    <p>{{ $secadoraAsignada->marca ?? 'No asignada' }} (SEC {{ $secadoraAsignada->id_maquina ?? '-' }})</p>
                </div>
            @endif

            <div class="links">
                <a href="{{ route('historial.pedidos') }}" class="btn btn-danger">Retroceder</a> <!-- Solo botón para retroceder -->
                <a href="{{ route('pedido.exportar.pdf', ['id' => $pedido->id_pedido]) }}" class="btn btn-primary" target="_blank"><i class="far fa-file-pdf"></i> Exportar a PDF</a>
            </div>
        </div>
    </div>
</div>

@endsection
