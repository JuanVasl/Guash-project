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
                    <form action="{{ route('pedidos.guardar-direcc') }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="id_tipo_direcc">Tipo de dirección</label>
                            <select name="id_tipo_direcc" id="id_tipo_direcc" class="form-control" required>
                                <option value="" disabled selected>Seleccione un tipo</option>
                                @foreach($tiposDireccion as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="referencia">Referencia</label>
                            <input type="text" name="referencia" id="referencia" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="id_ubicacion">Ubicación</label>
                            <select name="id_ubicacion" id="id_ubicacion" class="form-control" required>
                                <option value="" disabled selected>Seleccione una ubicación</option>
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Finalizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
