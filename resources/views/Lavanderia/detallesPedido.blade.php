@extends('layauts.base')
@section('title', 'Lavanderia')
@section('content')
<!-- Título -->
<div class="container">
    <div class="col-12">
        <h3 class="text-center"><strong>Detalles del pedido #{{ $pedido->id_pedido }}</strong></h3>
    </div>
</div>

<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
            <div class="form-group d-flex justify-content-start">
                <label><strong>Fecha:&nbsp;</strong></label>
                <p>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Dirección:&nbsp;</strong></label>
                <p>{{ $cliente->direccion }} {{ $cliente->referencia }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Cliente:&nbsp;</strong></label>
                <p>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Teléfono:&nbsp;</strong></label>
                <p>{{ $cliente->tele_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Servicio:&nbsp;</strong></label>
                <p>{{ $servicios->servicio }}</p>
            </div>
            <div class="form-group d-flex justify-content-start">
                <label><strong>Estado:&nbsp;</strong></label>
                <p>{{ $estados->estado }}</p>
            </div>
            <!-- Mostrar cantidad de canastos -->
            <div class="form-group d-flex justify-content-start">
                <label><strong>Canastos:&nbsp;</strong></label>
                <p>{{ $pedido->cant_canasto }}</p>
                <!-- Espacio adicional -->
                <span style="margin: 0 15px;"></span> <!-- Ajusta el margen según sea necesario -->
                <label><strong>Total del Servicio:&nbsp;</strong></label>
                <p>{{ $servicios->moneda ?? 'Q' }}{{ $pedido->total_servicio }}</p> <!-- Si manejas una moneda, se puede ajustar -->
            </div>

            <!-- Mostrar Lavadora o Secadora asignada -->
            @if ($pedido->id_precio_serv == 1) <!-- Si es Lavado -->
                <div class="form-group d-flex justify-content-start">
                    <label><strong>Lavadora:&nbsp;</strong></label>
                    <p>LAV{{ $lavadoraAsignada->id_maquina ?? '-' }}</p>
                </div>
                @if ($lavadoraAsignada && $pedido->id_estado != 4 && $pedido->id_estado != 6) <!-- Solo mostrar si no está en estado 4 o 6 -->
                    <form action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST">
                        @csrf
                        <input type="hidden" name="estado" value="4">
                        <button type="submit" class="btn btn-success">Comenzar Lavado</button>
                    </form>
                @endif
            @elseif ($pedido->id_precio_serv == 2) <!-- Si es Secado -->
                <div class="form-group d-flex justify-content-start">
                    <label><strong>Secadora:&nbsp;</strong></label>
                    <p>SEC{{ $secadoraAsignada->id_maquina ?? '-' }}</p>
                </div>
                @if ($secadoraAsignada && $pedido->id_estado != 5 && $pedido->id_estado != 6) <!-- Solo mostrar si no está en estado 4 o 6 -->
                    <form action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST">
                        @csrf
                        <input type="hidden" name="estado" value="5">
                        <button type="submit" class="btn btn-success">Comenzar Secado</button>
                    </form>
                @endif
            @elseif ($pedido->id_precio_serv == 3) <!-- Si es Lavado y Secado -->
                <div class="form-group d-flex justify-content-start">
                    <label><strong>Lavadora:&nbsp;</strong></label>
                    <p>LAV{{ $lavadoraAsignada->id_maquina ?? '-' }}</p>
                    <span style="margin: 0 10px;"></span>
                    <label><strong>Secadora:&nbsp;</strong></label>
                    <p>SEC{{ $secadoraAsignada->id_maquina ?? '-' }}</p>
                </div>

                <!-- Lógica para mostrar botones según el estado -->
                @if ($lavadoraAsignada && $pedido->id_estado == 3) <!-- Si el estado es 3, mostrar Comenzar Lavado -->
                    <form action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST">
                        @csrf
                        <input type="hidden" name="estado" value="4">
                        <button type="submit" class="btn btn-success">Comenzar Lavado</button>
                    </form>
                @elseif ($secadoraAsignada && $pedido->id_estado == 4) <!-- Si el estado es 4, mostrar Comenzar Secado -->
                    <form action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST">
                        @csrf
                        <input type="hidden" name="estado" value="5">
                        <button type="submit" class="btn btn-success">Comenzar Secado</button>
                    </form>
                @endif
            @endif

            <!-- Finalizar servicio -->
            @if (
                    ($pedido->id_precio_serv == 1 && $pedido->id_estado == 4) ||  // Lavado, estado 4
                    ($pedido->id_precio_serv == 2 && $pedido->id_estado == 5) ||  // Secado, estado 5
                    ($pedido->id_precio_serv == 3 && $pedido->id_estado == 5)     // Lavado y Secado, estado 5
                )
                <form action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST" class="">
                @csrf
                    <input type="hidden" name="estado" value="6">
                    <button type="submit" class="btn btn-primary">Terminar Servicio</button>
                </form>
            @endif

            <form id="estadoPedidoForm" action="{{ route('estadoPedido', $pedido->id_pedido) }}" method="POST">
                @csrf
                @if ($pedido->id_estado == 2) <!-- Estado cuando el motorista está en camino -->
                    <div class="links mt-3">
                        <button type="submit" name="estado" value="3" class="btn btn-success" id="btnRecolectado">Recibir</button>
                    </div>
                    <div class="links mt-3">
                        <a href="/pedidos" class="btn btn-danger mt-2">Regresar</a>
                    </div>
                @elseif ($pedido->id_estado == 3) <!-- Mostrar botones según la cantidad de canastos -->
                    @if ($pedido->cant_canasto == 0) <!-- Mostrar botón de Calcular Canastos si no hay canastos -->
                        <div class="links">
                            <a href="{{ route('calcularCanastos', ['id_pedido' => $pedido->id_pedido]) }}" class="btn btn-success">Calcular Canastos</a>
                            <a href="/pedidos" class="btn btn-danger">Regresar</a>
                        </div>
                    @else <!-- Mostrar botón de Asignar Equipos si ya se han calculado canastos -->
                        <div class="links mt-1">
                            <!-- Verificar si ya tiene asignado un equipo -->
                            @if($lavadoraAsignada || $secadoraAsignada)
                                <a href="{{ route('asignar.equipos', ['id_pedido' => $pedido->id_pedido]) }}" class="btn btn-primary">Cambiar Equipo</a>
                             @else
                                <a href="{{ route('asignar.equipos', ['id_pedido' => $pedido->id_pedido]) }}" class="btn btn-primary">Asignar Equipos</a>
                            @endif
                            <a href="/pedidos" class="btn btn-danger">Regresar</a>
                        </div>
                    @endif
                @else <!-- Para cualquier otro estado -->
                    <div class="links mt-1">
                        <a href="/pedidos" class="btn btn-danger mt-2">Regresar</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif
@endsection
