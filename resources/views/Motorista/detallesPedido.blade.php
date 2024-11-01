@extends('layauts.base')
@section('title', 'Motorista')
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
                <label><strong>Teléfono:</strong></label>
                <p>{{ $cliente->tele_cliente }}</p>
            </div>
            <div class="form-group d-flex justify-content-center">
                <label><strong>Estado:</strong></label>
                <p>{{ $estados->estado }}</p>
            </div>


            <form id="estadoPedidoForm" action="{{ route('estadoPedidoMotorista', $pedido->id_pedido) }}" method="POST">
                @csrf
                @if ($pedido->id_estado == 1 || $pedido->id_estado == 6 || $pedido->id_estado == 9) <!-- Estado inicial -->
                <div class="links mt-3">
                    <button type="submit" name="estado" value="15" class="btn btn-success">Aceptar</button>
                    <a href="/entregas" class="btn btn-danger">Regresar</a>
                </div>
                @elseif ($pedido->id_estado == 15)
                    <!-- Estado cuando el motorista está en camino -->
                    <div class="links mt-3">
                        @if ($pedido->id_lavandero != null)
                            <!-- Si id_lavandero NO es nulo, muestra solo el botón Finalizar -->
                            <button type="submit" name="estado" value="7" class="btn btn-success"
                                    id="btnFinalizar">Finalizar Pedido</button>
                            <button type="submit" name="estado" value="9" class="btn btn-danger">No Entregado</button>
                        @else
                            <!-- Si id_lavandero es nulo, muestra los botones Recolectado y No recolectado -->
                            <button type="submit" name="estado" value="2" class="btn btn-success"
                                    id="btnRecolectado">Recolectado</button>
                            <button type="submit" name="estado" value="9" class="btn btn-danger">No recolectado</button>
                        @endif
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('estadoPedidoForm').addEventListener('submit', function(event) {
            const formData = new FormData(event.target);
            console.log('Form Data:', Array.from(formData.entries()));

            const isRecolectado = event.submitter && event.submitter.id === 'btnRecolectado';
            const isFinalizar = event.submitter && event.submitter.id === 'btnFinalizar';

            if (isRecolectado) {
                event.preventDefault();

                Swal.fire({
                    icon: 'success',
                    title: 'Pedido Recolectado',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Asegúrate de que el estado se envíe correctamente
                    const estadoInput = document.createElement('input');
                    estadoInput.type = 'hidden';
                    estadoInput.name = 'estado';
                    estadoInput.value = '2'; // Valor para "Recolectado"
                    event.target.appendChild(estadoInput);

                    this.submit();
                });
            }

            if (isFinalizar) {
                event.preventDefault();

                Swal.fire({
                    icon: 'success',
                    title: 'Pedido Finalizado',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Asegúrate de que el estado se envíe correctamente
                    const estadoInput = document.createElement('input');
                    estadoInput.type = 'hidden';
                    estadoInput.name = 'estado';
                    estadoInput.value = '7'; // Valor para "Finalizado"
                    event.target.appendChild(estadoInput);

                    this.submit();
                });
            }
        });
    </script>
@endsection
@endsection
