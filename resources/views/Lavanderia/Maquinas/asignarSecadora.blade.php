@extends('layauts.base')
@section('title', 'Asignar Secadora')
@section('content')

<div class="container">
    <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%; text-align:center;">
        <h3><strong>Asignar Equipo a <br> Pedido #{{ $pedido->id_pedido }}</strong></h3>

        <!-- Formulario para asignar secadora -->
        <form action="{{ route('guardar.asignacionSecadora', $pedido->id_pedido) }}" method="POST">
            @csrf
            <div class="form-group mt-3">
                <label for="id_maquina" class="form-label">Seleccionar Secadora:</label>
                <div class="custom-select-container d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/128/17393/17393708.png" alt="Secadoras" class="icon-secadora"> <!-- Cambié el icono para la secadora -->
                    <select name="id_maquina" id="id_maquina" class="form-select" required>
                        <option value="">Seleccionar secadora...</option> <!-- Opción por defecto -->
                        @foreach ($secadora as $secadoras)
                            <option value="{{ $secadoras->id_maquina }}">
                                SEC{{ $secadoras->id_maquina }} - {{ $secadoras->marca }} - {{ $secadoras->capacidad }}LBS
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Botón de asignar -->
            <button type="submit" class="btn btn-success mt-4" style="width: 100%;">Asignar Secadora</button>
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

    .icon-secadora {
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

