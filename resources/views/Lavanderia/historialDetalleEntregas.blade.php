@extends('layauts.base')
@section('title', 'Lavanderia')
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
                    <label><strong>Estado:</strong></label>
                    <p>{{ $estados->estado }}</p>
                </div>

                <form>
                    <div class="links mt-3">
                        <a href="/historial" class="btn btn-danger mt-2">Retroceder</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

