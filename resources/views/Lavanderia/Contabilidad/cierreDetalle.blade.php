@extends('layauts.base')
@section('title', 'Detalles del Cierre Diario')
@section('content')

<div class="container">
    <!-- Título -->
    <div class="container mt-2">
        <div class="col-12">
            <h3 class="text-start"><strong>Detalles del Cierre Diario</strong></h3>
        </div>
    </div>

    <!-- Detalles del cierre -->
    <ul class="list-group mt-4">
        <li class="list-group-item"><strong>ID:</strong> {{ $cierre->id_cierre }}</li>
        <li class="list-group-item"><strong>Fecha:</strong> {{ $cierre->fecha }}</li>
        <li class="list-group-item"><strong>Total Pedidos:</strong> {{ $cierre->total_pedidos }}</li>
        <li class="list-group-item"><strong>Total Ingresos:</strong> Q{{ $cierre->total_ingresos }}</li>
        <li class="list-group-item"><strong>Detergente Usado:</strong> {{ $cierre->detergente_usado }}</li>
        <li class="list-group-item"><strong>Suavizante Usado:</strong> {{ $cierre->suavizante_usado }}</li>
        <li class="list-group-item"><strong>Energía Consumida:</strong> {{ $cierre->energia_consumida }}Kwh</li>
        <li class="list-group-item"><strong>Agua Consumida:</strong> {{ $cierre->agua_consumida }} Litros</li>
        <li class="list-group-item"><strong>Gas Consumido:</strong> {{ $cierre->gas_consumido }} Libras</li>
    </ul>

    <a href="{{ route('cierre_diario.historico') }}" class="btn btn-danger mt-4">Volver a la lista</a>
</div>

@endsection
