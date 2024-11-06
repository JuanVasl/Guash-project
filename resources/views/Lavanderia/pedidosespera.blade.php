@extends('layauts.base')
@section('title', 'Lavanderia')
@section('content')
<!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Pedidos en Espera</strong></h3>
    </div>
</div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">

                <table class="table text-center">
                    <tbody>
                    @foreach($pedido as $pedidos)
                        <tr>
                            <td>{{$pedidos->id_pedido}}</td>
                            <td>{{ \Carbon\Carbon::parse($pedidos->fecha)->format('H:i') }}</td>
                            <td>{{$pedidos->nombre}}</td>
                            <td>{{$pedidos->cod}}</td>
                            <td>
                                <a href="{{ route('detallesPedido', $pedidos->id_pedido) }}" style="color: gray">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Paginacion -->
                {{ $pedido->links() }}
            </div>
        </div>
    </div>
    <br>

    <!--Boton para administrador-->
    <?php if ($usuario->id_rol == 2): ?>
        <div class="links">
            <a href="/menuAdmin" class="btn btn-danger">Regresar</a>
        </div>
    <?php endif; ?>

    <!--Boton para lavandero-->
   <?php if ($usuario->id_rol == 3): ?>
    <div class="links">
        <a href="/menuLavan" class="btn btn-danger">Regresar</a>
    </div>
    <?php endif; ?>

</div>
@endsection
