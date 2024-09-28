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
                <label><strong>Estado:</strong></label>
                <p>{{ $estados->estado }}</p>
            </div>
            <form id="estadoPedidoForm" action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST">
    @csrf
    @if ($pedido->id_estado == 15) <!-- Estado cuando el motorista está en camino -->
        <div class="links mt-3">
            <button type="submit" name="estado" value="3" class="btn btn-success" id="btnRecolectado">Recibir</button>
        </div>
        <div class="links mt-3">
            <a href="/pedidos" class="btn btn-danger mt-2">Retroceder</a>
        </div>
    @elseif ($pedido->id_estado == 3) <!-- Mostrar botón Calcular Canastos si el estado es 3 -->
        <div class="links mt-3">
            <button type="button" class="btn btn-success">Calcular Canastos</button>
        </div>
        <div class="links mt-3">
            <a href="/pedidos" class="btn btn-danger mt-2">Retroceder</a>
        </div>
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
