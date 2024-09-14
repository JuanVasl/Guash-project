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
                <h3 class="text-start"><strong>¿Qué servicio desea?</strong></h3>
            </div>
        </div>

        <!-- Formulario central -->
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="btn-container p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%;">
                    <form action="{{ route('pedidos.guardar-paso3', $pedido) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_precio_serv">Servicio</label>
                            <select name="id_precio_serv" id="id_precio_serv" class="form-control" required>
                                @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }} - ${{ $servicio->precio }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Finalizar pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
