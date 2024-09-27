@extends('layauts.plantillacliente')
@section('title', 'Cliente')
@section('content')
    <div class="container">
        <!-- Título -->
        <div class="container mt-5">
            <div class="col-12">
                <h3 class="text-start"><strong>¿Cuándo lo recolectamos?</strong></h3>
            </div>
        </div>
        <!-- Formulario central -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <form action="{{ route('pedidos.guardarProgramacion', $pedido->id_pedido) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fecha_programada" class="form-label">Fecha y Hora</label>
                            <input type="datetime-local" id="fecha_programada" name="fecha_programada" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </form>
                    <!-- Formulario para eliminar el pedido -->
                    <form action="{{ route('pedidos.eliminar', $pedido->id_pedido) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
