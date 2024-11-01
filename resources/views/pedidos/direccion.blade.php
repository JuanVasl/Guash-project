@extends('layauts.plantillacliente')
@section('title', 'Cliente')
@section('content')

    <!-- Título -->
    <div class="container">
        <div class="col-12">
            <h3 class="text-start"><strong>¿Dónde lo recolectamos?</strong></h3>
        </div>
    </div>

    <!-- Formulario central -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                <form id="finPedido" action="{{ route('pedidos.guardar-direcc', ['pedido' => $pedido->id_pedido]) }}" method="POST">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="id_tipo_direcc">Tipo de dirección</label>
                        <select name="id_tipo_direcc" id="id_tipo_direcc" class="form-control" required>
                            <option value="" disabled>Seleccione un tipo</option>
                            @foreach($tiposDireccion as $tipo)
                                <option value="{{ $tipo->id_tipo_direcc }}" {{ $tipo->id_tipo_direcc == $tipo_direccion_actual ? 'selected' : '' }}>
                                    {{ $tipo->tipo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $cliente->direccion) }}" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="referencia">Referencia</label>
                        <input type="text" name="referencia" id="referencia" value="{{ old('referencia', $cliente->referencia) }} " class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="id_ubicacion">Ubicación</label>
                        <select name="id_ubicacion" id="id_ubicacion" class="form-control" required>
                            <option value="" disabled>Seleccione una ubicación</option>
                            @foreach($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id_ubicacion }}" {{ $ubicacion->id_ubicacion == $ubicacion_actual ? 'selected' : '' }}>
                                    {{ $ubicacion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button id="btnSolicitado" type="submit" class="btn btn-success mt-3">Finalizar</button>
                </form>
                <!-- Botón para Regresar a la vista de servicios -->
                <a href="{{ route('pedidos.servicios', ['pedido' => $pedido->id_pedido]) }}" class="btn btn-danger mt-3">Regresar</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('finPedido').addEventListener('submit', function(event) {
                event.preventDefault(); // Siempre prevenimos el envío inmediato

                Swal.fire({
                    icon: 'success',
                    title: 'Pedido Finalizado',
                    text: 'Tu pedido se está procesando...',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Enviar el formulario después de que se cierre el SweetAlert
                    event.target.submit();
                });
            });
        });
    </script>
@endsection
