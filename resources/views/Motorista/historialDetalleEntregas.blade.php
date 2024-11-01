@extends('layauts.base')
@section('title', 'Motorista')
@section('content')
    <!-- Título -->
    <div class="container">
        <div class="col-12">
            <h3 class="text-center"><strong>Detalles de historial de entregas</strong></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                <div class="text-center">
                    <h5><strong>{{ $pedido->id_pedido }} - {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}</strong></h5>
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
                    <label><strong>Fecha de finalizado:</strong></label>
                    <p>{{ \Carbon\Carbon::parse($historial->fecha)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <label><strong>Estado:</strong></label>
                    <p>{{ $historial->accion_realizada }}</p>
                </div>

                <form>
                    <div class="links mt-3">
                        <a href="/historial" class="btn btn-danger mt-2">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

