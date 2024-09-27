@extends('layauts.plantillacliente')
@section('title', 'Cliente')
@section('content')
    <div class="container">
        <!-- Título -->
        <div class="container mt-5">
            <div class="col-12">
                <h3 class="text-start"><strong>¿Qué servicio desea?</strong></h3>
            </div>
        </div>
        <!-- Formulario central -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <form action="{{ route('pedidos.guardar-servicios', $pedido) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_precio_serv">Servicio</label>
                            <select name="id_precio_serv" id="id_precio_serv" class="form-control" required>
                                <option value="" disabled selected>Seleccione el servicio</option>
                                @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->id_precio_serv }}">{{ $servicio->servicio }} - Q.{{ $servicio->precio }}/Canasto</option>
                                @endforeach
                            </select>
                            <p class="mt-1"><strong>El precio final esta sujeto a cantidad de canastos.</strong></p>
                        </div>
                        <button type="submit" class="btn btn-success mt-4">Continuar</button>
                    </form>
                    <!-- Formulario para eliminar el pedido -->
                    <form action="{{ route('pedidos.eliminar', $pedido) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
