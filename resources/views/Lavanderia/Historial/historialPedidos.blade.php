@extends('layauts.base')
@section('title', 'Historial de Pedidos')
@section('content')

<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Historial de Pedidos</strong></h3>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                <!-- Formulario para seleccionar la fecha y filtrar -->
    <div class="col-12">
        <form action="{{ route('historial.pedidos') }}" method="GET" class="row justify-content-center">
            <div class="col-12">
                <label for="fecha" class="col-form-label"><strong>Seleccionar fecha:</strong></label>
            </div>
            <div class="col-auto">
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $fecha }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <!-- Tabla con los pedidos filtrados -->
    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id_pedido }}</td>
                        <td>{{ $pedido->cliente->nombre_cliente }}</td>
                        <td>Q{{ $pedido->total_servicio }}</td>
                        <td>
                            <a href="{{ route('detalle.pedidoHistorico', $pedido->id_pedido) }}" style="color: gray">
                                <i class="fas fa-angle-double-right"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">ℹ No se encontraron pedidos.</td> <!-- Ajustar colspan -->
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Mostrar la paginación -->
        <div class="d-flex justify-content-center">
            {{ $pedidos->appends(['fecha' => $fecha])->links() }}
        </div>
    </div>
            </div>
        </div>
    </div>
</div>

<!--Boton para administrador-->
<?php if ($usuario->id_rol == 2): ?>
<br>
<div class="links">
    <a href="/menuAdmin" class="btn btn-danger">Regresar</a>
</div>
<?php endif; ?>

    <!--Boton para lavandero-->
<?php if ($usuario->id_rol == 3): ?>
<br>
<div class="links">
    <a href="/menuLavan" class="btn btn-danger">Regresar</a>
</div>
<?php endif; ?>

@endsection

