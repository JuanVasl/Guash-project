@extends('layauts.base')
@section('title', 'Lavanderia')
@section('content')
<!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Detalles de pedido</strong></h3>
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
            <div class="text-center">
                <h5><strong>{{ $pedido->id_pedido }} - {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/y') }}</strong></h5>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label><strong>Dirección:</strong></label>
                <p>{{ $cliente->direccion }} {{ $cliente->referencia }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Cliente:</strong></label>
                <p>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-start" >
                <label><strong>Teléfono:</strong></label>
                <p>{{ $cliente->tele_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Servicio:</strong></label>
                <p>{{ $servicios->servicio }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Estado:</strong></label>
                <p>{{ $estados->estado }}</p>
            </div>
            <!-- Mostrar cantidad de canastos -->
            <div class="form-group d-flex justify-content-start">
                <label><strong>Canastos:</strong></label>
                <p>{{ $pedido->cant_canasto }}</p>
            </div>

            <!-- Mostrar total del servicio -->
            <div class="form-group d-flex justify-content-start">
                <label><strong>Total del Servicio:</strong></label>
                <p> {{ $servicios->moneda ?? 'Q' }}{{ $pedido->total_servicio }}</p> <!-- Si manejas una moneda, se puede ajustar -->
            </div>

            <form id="estadoPedidoForm" action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST">
                @csrf
                @if ($pedido->id_estado == 2) <!-- Estado cuando el motorista está en camino -->
                    <div class="links mt-3">
                        <button type="submit" name="estado" value="3" class="btn btn-success" id="btnRecolectado">Recibir</button>
                    </div>
                    <div class="links mt-3">
                        <a href="/pedidos" class="btn btn-danger mt-2">Retroceder</a>
                    </div>
                @elseif ($pedido->id_estado == 3) <!-- Mostrar botones según la cantidad de canastos -->
                    @if ($pedido->cant_canasto == 0) <!-- Mostrar botón de Calcular Canastos si no hay canastos -->
                        <div class="links mt-3">
                            <a href="{{ route('calcularCanastos', ['id_pedido' => $pedido->id_pedido]) }}" class="btn btn-success">Calcular Canastos</a>
                            <a href="/pedidos" class="btn btn-danger">Retroceder</a>
                        </div>
                    @else <!-- Mostrar botón de Asignar Equipos si ya se han calculado canastos -->
                        <div class="links mt-1">
                            <a href="{{ route('asignar.equipos', ['id_pedido' => $pedido->id_pedido]) }}" class="btn btn-primary">Asignar Equipos</a>
                            <a href="/pedidos" class="btn btn-danger">Retroceder</a>
                        </div>
                    @endif
                @else <!-- Para cualquier otro estado -->
                    <div class="links mt-3">
                        <a href="/pedidos" class="btn btn-danger mt-2">Retroceder</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection
