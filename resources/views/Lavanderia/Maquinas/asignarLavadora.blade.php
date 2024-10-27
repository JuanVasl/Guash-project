@extends('layauts.base')
@section('title', 'Asignar Lavadora')
@section('content')

<div class="container">
    <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%; text-align:center;">
        <h3><strong>Asignar Lavadora <br> Pedido #{{ $pedido->id_pedido }}</strong></h3>

         <!-- Formulario para asignar lavadora -->
         <form action="{{ route('guardar.asignacionLavadora', $pedido->id_pedido) }}" method="POST">
            @csrf
            <div class="form-group mt-3">
                <label for="id_lavadora" class="form-label">Seleccionar Lavadora:</label>
                <div class="custom-select-container d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/128/2796/2796427.png" alt="Lavadoras" class="icon-lavadora">
                    <select name="id_maquina" id="id_lavadora" class="form-select" required>
                        <option value="">Seleccionar lavadora...</option> <!-- Opción por defecto -->
                        @foreach ($lavadora as $lavadoras)
                            <option value="{{ $lavadoras->id_maquina }}">
                                LAV{{ $lavadoras->id_maquina }} - {{ $lavadoras->marca }} - {{ $lavadoras->capacidad }}LBS
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Botón de asignar -->
            <button type="submit" class="btn btn-success mt-4" style="width: 100%;">Asignar Lavadora</button>
            <a href="{{ route('detallesPedido', $pedido->id_pedido) }}" class="btn btn-danger mt-2" style="width: 100%;">Retroceder</a>
        </form>
    </div>
</div>

<!-- Estilos CSS embebidos -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 400px;
        margin: auto;
    }

    h3 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-select {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #fff;
        width: 100%; /* Abarca todo el espacio disponible */
    }

    .custom-select-container {
        display: flex;
        align-items: center; /* Centra verticalmente los elementos */
    }

    .icon-lavadora {
        width: 80px; /* Ajusta el tamaño de la imagen */
        height: auto;
    }

    .btn-container {
        background-color: #d9d9d9;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
    }

</style>
@endsection
