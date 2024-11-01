@extends('layauts.base')
@section('title', 'Asignar Lavadora y Secadora')
@section('content')

<div class="container">
    <div class="btn-container mt-4 p-3" style="background-color: rgb(217, 217, 217); border-radius: 15px; width: 100%; text-align:center;">
        <h3><strong>Asignar Equipos a <br> Pedido #{{ $pedido->id_pedido }}</strong></h3>

        <!-- Formulario para asignar lavadora y secadora -->
        <form action="{{ route('guardar.asignacionLavadoraSecadora', $pedido->id_pedido) }}" method="POST">
            @csrf

            <!-- Seleccionar Lavadora -->
            <div class="form-group mt-3">
                <div class="custom-select-container d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/128/2796/2796427.png" alt="Lavadoras" class="icon-lavadora">
                    <select name="id_lavadora" id="id_lavadora" class="form-select" required>
                        <option value="">Seleccionar lavadora...</option>
                        @foreach ($lavadora as $lavadoras)
                            <option value="{{ $lavadoras->id_maquina }}">
                                LAV{{ $lavadoras->id_maquina }} - {{ $lavadoras->marca }} - {{ $lavadoras->capacidad }}LBS
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Seleccionar Secadora -->
            <div class="form-group mt-3">
                <div class="custom-select-container d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/128/17393/17393708.png" alt="Secadoras" class="icon-secadora">
                    <select name="id_secadora" id="id_secadora" class="form-select" required>
                        <option value="">Seleccionar secadora...</option>
                        @foreach ($secadora as $secadoras)
                            <option value="{{ $secadoras->id_maquina }}">
                                SEC{{ $secadoras->id_maquina }} - {{ $secadoras->marca }} - {{ $secadoras->capacidad }}LBS
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Botón de asignar -->
            <button type="submit" class="btn btn-success mt-4" style="width: 100%;">Asignar Lavadora y Secadora</button>
            <a href="{{ route('detallesPedido', $pedido->id_pedido) }}" class="btn btn-danger mt-2" style="width: 100%;">Regresar</a>
        </form>
    </div>
</div>

<!-- Estilos CSS embebidos -->
<style>
    .custom-select-container {
        display: flex;
        align-items: center;
    }

    .icon-lavadora, .icon-secadora {
        width: 80px;
        height: auto;
    }
</style>
@endsection
