@extends('layauts.plantillacliente')
@section('title', 'Historial de Pedidos')

@section('content')
    <!-- Título -->
    <div class="container">
        <div class="col-12 mt-3">
            <h3 class="text-center"><strong>Historial de Pedidos</strong></h3>
        </div>
    </div>
    <!-- Buscador por fecha -->
    <div class="row mt-4">
        <div class="row">
            <form method="GET" action="{{ route('pedidos.historial') }}">
                <div class="input-group">
                    <input type="date" name="fecha" class="form-control" placeholder="Buscar por fecha">
                    <div class="input-group-append">
                        <button class="btn" type="submit">🔎</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row mt-3">
            <form method="GET" action="{{ route('pedidos.historial') }}">
                <div class="input-group">
                    <select name="estado" class="form-control">
                        <option value="">Seleccionar estado</option>
                        <option value="1">Pendiente de recolectar</option>
                        <option value="2">Recolectado</option>
                        <option value="3">En lavandería</option>
                        <option value="4">Lavando</option>
                        <option value="5">Secado</option>
                        <option value="6">Pendiente de enviar</option>
                        <option value="7">Entregado</option>
                        <option value="8">Reprogramado</option>
                        <option value="9">Cliente no disponible</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn" type="submit">✅</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .input-group {
            height: 50px;
        }
    </style>

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-3 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                @if($pedidos->isEmpty())
                    <p class="mt-4 text-center">No tienes pedidos anteriores.</p>
                @else
                    <table class="table text-center">
                        <tbody>
                        @foreach($pedidos as $pedido)
                            <tr onclick="window.location='{{ route('pedidos.detalle', $pedido->id_pedido) }}'" style="cursor: pointer;">
                                <td><strong>{{ $pedido->id_pedido }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}</td>
                                <td>{{ $pedido->precioServicio->servicio ?? 'N/A' }}</td>
                                <td>{{ $pedido->estado->estado ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <div class="items-center">
                                    {{ $pedidos->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <a href="/menu" class="btn btn-danger mt-4">Regresar</a>
@endsection
