@extends('layauts.plantillacliente')
@section('title', 'Cliente')
@section('content')
    <div class="container">
        <!-- Logotipo y Texto de Bienvenida -->
        <div class="row mb-5">
            <div class="col-4 justify-content-center">
                <img src="{{ asset('images/logo_guash.png') }}" alt="Logotipo" class="img-fluid">
            </div>
            <div class="col-8 d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-center"><strong>Bienvenido(a)</strong></h2>
                <p class="text-center"><strong>{{ Auth::user()->nombre_cliente }} {{ Auth::user()->apellido_cliente }}</strong></p>
            </div>
        </div>

        <!-- Título -->
        <div class="container mt-5">
            <div class="col-12">
                <h3 class="text-start"><strong>¿Dónde lo recolectamos?</strong></h3>
            </div>
        </div>

        <!-- Formulario central -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <form action="{{ route('pedidos.guardar-direcc', $pedido) }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="id_tipo_direcc">Tipo de dirección</label>
                            <select name="id_tipo_direcc" id="id_tipo_direcc" class="form-control" required>
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
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Siguiente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
